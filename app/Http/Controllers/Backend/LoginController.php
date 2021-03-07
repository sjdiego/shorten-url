<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController
{
    public function render()
    {
        return Inertia::render('login/Page', [
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

            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
