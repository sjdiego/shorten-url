<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class LoginController
{
    public function render()
    {
        return Inertia::render('LoginPage', [
            'authRoute' => route('auth')
        ]);
    }

    public function auth()
    {
        dd(request()->all());
    }
}
