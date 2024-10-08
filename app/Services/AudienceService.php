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
    public function createAudience(string $name, int $capacity): Audience
    {
        $audienceData = [
            'name' => $name,
            'capacity' => $capacity,
        ];
        return Audience::create($audienceData);
    }

    /**
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

    public function updateAudience(int $id, string $name, int $capacity)
    {
        $audience = Audience::findOrFail($id);
        $audienceData = [
            'name' => $name,
            'capacity' => $capacity,
        ];
        return $audience->update($audienceData);
    }

    public function deleteAudience(int $id)
    {
        $audience = Audience::findOrFail($id);
        return $audience->delete();
    }
}
