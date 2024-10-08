<?php

namespace App\Http\Controllers\apiv1;

use App\Exceptions\AudienceNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\AudienceRequest;
use App\Http\Resources\AudienceResource;
use App\Services\AudienceService;
use Illuminate\Database\QueryException;
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
     * @return AudienceResource|JsonResponse
     */
    public function createAudience(AudienceRequest $request): AudienceResource|JsonResponse
    {
        try {
            $request->validate();
            $audience = $this->audienceService->createAudience($request->input('name'), $request->input('capacity'));

            return new AudienceResource($audience);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Ошибка создания аудитории'], $e->getCode());
        }
    }

    /**
     * R - Get audience by ID.
     *
     * @param int $id
     * @return AudienceResource|JsonResponse
     */
    public function getAudienceById(int $id): AudienceResource|JsonResponse
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
     * @throws AudienceNotFoundException
     */
    public function updateAudience(AudienceRequest $request, int $id): JsonResponse
    {
        try {
            $request->validate();
            $result = $this->audienceService->updateAudience(
                $id,
                $request->input('name'),
                $request->input('capacity')
            );

            if ($result) {
                return response()->json(['success' => true], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'Ошибка при обновлении аудитории'], 400);
            }
        } catch (AudienceNotFoundException $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * D - Soft-delete audience.
     *
     * @param int $id
     * @return JsonResponse
     * @throws AudienceNotFoundException
     */
    public function deleteAudience(int $id): JsonResponse
    {
        try {
            $result = $this->audienceService->deleteAudience($id);

            if ($result) {
                return response()->json(['success' => true], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'Ошибка при удалении аудитории'], 400);
            }
        } catch (AudienceNotFoundException $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
