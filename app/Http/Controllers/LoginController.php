<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class LoginController
{
    public function render()
    {
        return Inertia::render('Login');
    }
}
