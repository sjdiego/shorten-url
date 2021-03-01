<?php

namespace App\Http\Controllers;

class ShortenListController
{
    public function list()
    {
        dd(app()->auth());
    }
}
