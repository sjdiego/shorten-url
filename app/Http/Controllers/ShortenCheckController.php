<?php

namespace App\Http\Controllers;

use App\Domain\Shorten\Events\ShortenHit;
use App\Http\Resources\ShortenResource;
use App\Models\Shorten;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class ShortenCheckController extends Controller
{
    public function __invoke(string $slug)
    {
        try {
            $shorten = Shorten::whereSlug($slug)->sole();

            $shorten->addHit();

            return response()->json(
                ShortenResource::make($shorten),
                JsonResponse::HTTP_OK
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                ['error' => 'The requested code was not found'],
                JsonResponse::HTTP_NOT_FOUND
            );
        } catch (Exception $e) {
            return response()->json(
                ['error' => $e->getMessage()],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
