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
    /**
     * Class that manages Shorten creation model
     *
     * @param ShortenCreateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Post(
     *     path="/api/v1/shorten/create",
     *     summary="Creates a Shorten record",
     *     description="It returns the data of created Shorten with provided data",
     *     @OA\Response(response=200, description="Shorten is created successfully"),
     *     @OA\Response(response=422, description="Provided data for Shorten is not valid"),
     *     @OA\Response(response=500, description="Internal server error")
     * )
     */
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
