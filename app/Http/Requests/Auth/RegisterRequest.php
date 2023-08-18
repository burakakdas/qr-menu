<?php

namespace App\Http\Requests\Auth;

use App\Helpers\PhoneHelper;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'phone' => PhoneHelper::reformatPhoneData($this->phone),
        ]);
    }

    public function rules()
    {
        return [
            'first_name' => ['bail', 'required', 'string', 'max:255'],
            'last_name' => ['bail', 'required', 'string', 'max:255'],
            'company_name' => ['bail', 'required', 'string', 'max:255'],
            'email' => ['bail', 'required', 'email', 'max:255', sprintf('unique:%s,email', User::class)],
            'phone' => ['bail', 'required', 'digits:10'],
            'password' => ['bail', 'required', 'confirmed', Password::defaults()],
            'communication' => ['bail', 'sometimes', 'accepted', 'digits_between:1,1'],
            'contract' => ['bail', 'required', 'accepted', 'digits_between:1,1'],
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validatedData = parent::safe()->all();

        $validatedData['password'] = Hash::make($validatedData['password']);

        return $validatedData;
    }
}
