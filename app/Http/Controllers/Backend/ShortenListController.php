<?php

namespace App\Http\Controllers\Backend;

use App\Models\Shorten;
use Inertia\Inertia;

class ShortenListController
{
    public function __invoke()
    {
        return Inertia::render('Shortens', [
            'shortens' => Shorten::orderBy('id', 'asc')->get()
        ]);
    }
}
