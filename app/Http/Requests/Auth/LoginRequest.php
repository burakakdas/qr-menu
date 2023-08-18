<?php

namespace App\Http\Requests\Auth;

use App\Models\CompanyUser;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate(): User
    {
        $this->ensureIsNotRateLimited();

        $user = User::where([
            ['email', $this->safe()->only('email')],
            ['is_active', true],
        ])
            ->whereHas('company', function (Builder $builder) {
                $builder->whereIsActive(true);
            })
            ->with(['company:id,name,settings'])
            ->first(['id', 'password', 'company_id']);

        if ($user === null || ! Hash::check($this->safe()->only('password')['password'], $user->password)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        if ($user->hasRole([Role::NAME_COMPANY_MANAGER, Role::NAME_SYSTEM_USER], User::GUARD_NAME_COMPANY)) {
            Auth::guard(User::GUARD_NAME_COMPANY)->login($user, $this->filled('remember'));
        }

        RateLimiter::clear($this->throttleKey());

        return $user;
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')).'|'.$this->ip());
    }
}
