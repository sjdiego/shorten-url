<?php

namespace App\Http\Controllers\Backend;

use App\Models\Shorten;
use Inertia\Inertia;

class BackendController
{
    const ITEMS_PER_PAGE = 10;

    public function render()
    {
        return Inertia::render('Dashboard', [
            'shortens' => Shorten::select(['id', 'url', 'slug'])
                ->get()
                ->forPage(1, self::ITEMS_PER_PAGE)
        ]);
    }
}
