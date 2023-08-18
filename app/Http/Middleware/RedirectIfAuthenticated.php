<?php

namespace App\Http\Middleware;

use App\Helpers\Enums\FrontEndAdminUrl;
use App\Helpers\Enums\FrontEndCompanyUrl;
use App\Helpers\FrontEndUrlHelper;
use App\Http\Resources\RedirectResponseResource;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response | RedirectResponseResource
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if (Auth::guard(User::GUARD_NAME_ADMIN)->check()) {
                    return new RedirectResponseResource(FrontEndUrlHelper::generateUrl(FrontEndAdminUrl::HOME));
                }

                if (Auth::guard(User::GUARD_NAME_COMPANY)->check()) {
                    return new RedirectResponseResource(FrontEndUrlHelper::generateUrl(FrontEndCompanyUrl::HOME));
                }

            }
        }

        return $next($request);
    }
}
