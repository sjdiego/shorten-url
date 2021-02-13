<?php

namespace App\Http\Controllers;

use App\Domain\Shorten\ShortenAggregateRoot;
use Illuminate\Support\Str;
use App\Http\Resources\{ShortenResource, ShortenFailedResource};
use App\Models\Shorten;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class ShortenCheckController extends Controller
{
    public function __invoke(string $slug)
    {
        try {
            $shorten = Shorten::findBySlug($slug);

            if (!$shorten->addHit()) {
                return response()->json(ShortenFailedResource::make($shorten), JsonResponse::HTTP_FORBIDDEN);
            }

            return response()->json(ShortenResource::make($shorten), JsonResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], JsonResponse::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
