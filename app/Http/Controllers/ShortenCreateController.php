<?php

namespace App\Http\Controllers;

use App\Domain\Shorten\Events\ShortenCreated;
use App\Domain\Shorten\ShortenAggregateRoot;
use App\Http\Requests\ShortenCreateRequest;
use App\Models\Shorten;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\JsonResponse;

class ShortenCreateController
{
    public function __invoke(ShortenCreateRequest $request)
    {
        $attributes = [
            'uuid' => Str::uuid()->toString(),
            'slug' => Shorten::generateUniqueSlug(),
            'url' => $request->get('url'),
            'created_at' => Carbon::now()->toDateTimeString(),
        ];

        event(new ShortenCreated($attributes));

        return response()->json($attributes, JsonResponse::HTTP_OK);
    }
}
