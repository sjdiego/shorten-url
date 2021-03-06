<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController
{
    public function render()
    {
        return Inertia::render('LoginPage', [
            'authRoute' => route('auth')
        ]);
    }

    public function auth(LoginRequest $request)
    {
        try {
            Auth::attempt([
                'email' => $request->get('user'),
                'password' => $request->get('password'),
            ]);
            
            if (!Auth::check()) {
                throw new \Exception('The provided data is not correct. Please verify the details and try again.');
            }

            return redirect()->route('shorten.list');
        } catch (\Exception $e) {
            return response()->json(
                [
                    'error' => $e->getMessage(),
                    'data' => $request->except('password'),
                ],
                JsonResponse::HTTP_FORBIDDEN
            );
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
