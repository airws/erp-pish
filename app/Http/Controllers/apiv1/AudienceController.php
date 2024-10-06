<?php

namespace App\Http\Controllers\apiv1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AudienceRequest;
use App\Services\AudienceService;
use Illuminate\Http\JsonResponse;

/**
 * Class AudienceController
 *
 * @package App\Http\Controllers\apiv1
 */
class AudienceController extends Controller
{
    /**
     * C - Create audience.
     *
     * @param AudienceRequest $request
     * @return JsonResponse
     */
    public function createAudience(AudienceRequest $request): JsonResponse
    {
        $request = $request->validated();
        $audience = AudienceService::createAudience($request->name, $request->capacity);
        return response()->json(new AudienceResource(), 201);
    }

    /**
     * R - Get audience by ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function getAudienceById(int $id): JsonResponse
    {
        $audience = AudienceService::getAudienceById($id);
        return response()->json(new AudienceResource(), 200);
    }

    /**
     * U - Update audience.
     *
     * @param AudienceRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateAudience(AudienceRequest $request, int $id): JsonResponse
    {
        $request = $request->validated();
        $isUpdated = AudienceService::updateAudience($id, $request->name, $request->capacity);
        return response()->json(new AudienceResource(), 200);
    }

    /**
     * D - Soft-delete audience.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function deleteAudience(int $id): JsonResponse
    {
        $isDeleted = AudienceService::deleteAudience($id);
        return response()->json(null, 204);
    }
}
