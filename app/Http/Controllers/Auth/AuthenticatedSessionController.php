<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        $user = $request->authenticate();

        $token = $user->createToken(User::TOKEN_WEB)->plainTextToken;
        //TODO logoutOtherDevices
        return $this->successJsonResponse(data: [User::TOKEN_WEB => $token], headers: [User::TOKEN_WEB => $token]);

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return $this->successJsonResponse();
    }
}
