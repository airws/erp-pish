<?php

namespace App\Services;

use App\Exceptions\AudienceNotFoundException;
use App\Http\Resources\AudienceResource;
use App\Models\Audience;

/**
 * Class AudienceService
 *
 * Сервис для управления аудиториями.
 *
 * @package App\Services
 */
class AudienceService
{
    /**
     * @param string $name
     * @param int $capacity
     * @return Audience
     */
    public function createAudience(string $name, int $capacity): Audience
    {
        $audienceData = [
            'name' => $name,
            'capacity' => $capacity,
        ];
        return Audience::create($audienceData);
    }

    /**
     * @param int $id
     * @return Audience
     * @throws AudienceNotFoundException
     */
    public function getAudienceById(int $id): Audience
    {
        $audience = Audience::find($id);
        if (!$audience) {
            throw new AudienceNotFoundException();
        }
        return $audience;
    }

    /**
     * @param int $id
     * @param string $name
     * @param int $capacity
     * @return bool
     * @throws AudienceNotFoundException
     */
    public function updateAudience(int $id, string $name, int $capacity): bool
    {
        $audience = Audience::find($id);
        if (!$audience) {
            throw new AudienceNotFoundException();
        }
        return $audience->update([
            'name' => $name,
            'capacity' => $capacity,
        ]);
    }

    /**
     * @param int $id
     * @return bool
     * @throws AudienceNotFoundException
     */
    public function deleteAudience(int $id): bool
    {
        $audience = Audience::find($id);
        if (!$audience) {
            throw new AudienceNotFoundException();
        }
        return $audience->delete();
    }
}
