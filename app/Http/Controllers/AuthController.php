<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Authentication an user
     * @param  \Illuminate\Http\Request  $request
     * @return token string
     * @return App\Models\User user
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return ['token' => $user->createToken($request->email)->plainTextToken, 'user' => $user];
    }

    /**
     * Logout an user
     * @param  \Illuminate\Http\Request  $request
     * @return status string
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return ['status' => 'logged out'];
    }
}
