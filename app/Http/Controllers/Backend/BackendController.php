<?php

namespace App\Http\Controllers\Backend;

use App\Models\Shorten;
use Inertia\Inertia;

class BackendController
{
    public function render()
    {
        return Inertia::render('Dashboard', [
            'shortens' => Shorten::orderBy('id', 'desc')->take(10)->get()
        ]);
    }
}
