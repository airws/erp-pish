<?php

namespace App\Http\Controllers\apiv1;

use App\Exceptions\AudienceNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\AudienceRequest;
use App\Http\Resources\AudienceResource;
use App\Services\AudienceService;
use Illuminate\Http\JsonResponse;

/**
 * Class AudienceController
 *
 * @package App\Http\Controllers\apiv1
 */
class AudienceController extends Controller
{
    private AudienceService $audienceService;

    public function __construct(AudienceService $audienceService)
    {
        $this->audienceService = $audienceService;
    }
    /**
     * C - Create audience.
     *
     * @param AudienceRequest $request
     * @return AudienceResource
     */
    public function createAudience(AudienceRequest $request): AudienceResource
    {
        $request->validate();
        $audience = $this->audienceService->createAudience($request->input('name'), $request->input('capacity'));
        return new AudienceResource($audience);
    }

    /**
     * R - Get audience by ID.
     *
     * @param int $id
     * @return AudienceResource
     */
    public function getAudienceById(int $id): AudienceResource
    {
        try {
            $audience = $this->audienceService->getAudienceById($id);
            return new AudienceResource($audience);
        } catch (AudienceNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
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
        $request->validate();
        $isUpdated = $this->audienceService->updateAudience(
            $id,
            $request->input('name'),
            $request->input('capacity')
        );
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
        $isDeleted = $this->audienceService->deleteAudience($id);
        return response()->json(null, 204);
    }
}
