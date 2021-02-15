<?php

namespace App\Http\Controllers;

use App\Domain\Shorten\Events\ShortenCreated;
use App\Http\Requests\ShortenCreateRequest;
use App\Http\Resources\ShortenResource;
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

        if ($request->has('maxHits')) {
            $attributes['max_hits'] = $request->get('maxHits');
        }

        if ($request->has('expiresAt')) {
            $date = Carbon::parse($request->get('expiresAt'))->toDateString();
            $attributes['expires_at'] = $date;
        }

        event(new ShortenCreated($attributes));

        $shorten = Shorten::uuid($attributes['uuid']);

        return response()->json(ShortenResource::make($shorten), JsonResponse::HTTP_OK);
    }
}
