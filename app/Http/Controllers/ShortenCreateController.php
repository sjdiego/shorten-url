<?php

namespace App\Http\Controllers;

use App\Domain\Shorten\Events\ShortenCreated;
use App\Domain\Shorten\ShortenAggregateRoot;
use App\Http\Requests\ShortenCreateRequest;
use App\Models\Shorten;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\JsonResponse;

class ShortenCreateController
{
    public function __invoke(ShortenCreateRequest $request)
    {
        $event = new ShortenCreated([
            'uuid' => Str::uuid()->toString(),
            'slug' => Shorten::generateUniqueSlug(),
            'url' => $request->get('url'),
        ]);

        ShortenAggregateRoot::retrieve(Str::uuid()->toString())
            ->createShorten($event->shortenAttributes)
            ->persist();

        return response()->json(
            [$event->shortenAttributes],
            JsonResponse::HTTP_OK
        );
    }
}
