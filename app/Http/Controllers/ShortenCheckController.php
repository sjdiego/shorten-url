<?php

namespace App\Http\Controllers;

use App\Http\Resources\{ShortenResource, ShortenFailedResource};
use App\Models\Shorten;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

/**
 * Class ShortenCheckController
 * @package App\Http\Controllers
 */
class ShortenCheckController extends Controller
{
    /**
     * Class that manages Shorten checking item
     *
     * @param string $slug
     *
     * @return JsonResponse
     *
     * @OA\Get(
     *     path="/api/v1/shorten/check/{slug}",
     *     summary="Checks for Shorten by code",
     *     description="It returns the data of Shorten related to provided code",
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         required=true,
     *         description="Code of Shorten"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="The Shorten code exists and is not expired"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unable to get data of requested Shorten"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Shorten not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */
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
