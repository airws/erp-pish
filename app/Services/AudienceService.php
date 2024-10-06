<?php

namespace App\Services;

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
    public static function createAudience(string $name, int $capacity)
    {
        $audienceData = [
            'name' => $name,
            'capacity' => $capacity,
        ];
        return Audience::create($audienceData);
    }

    public static function getAudienceById(int $id)
    {
        return Audience::findOrFail($id);
    }

    public static function updateAudience(int $id, string $name, int $capacity)
    {
        $audience = Audience::findOrFail($id);
        $audienceData = [
            'name' => $name,
            'capacity' => $capacity,
        ];
        return $audience->update($audienceData);
    }

    public static function deleteAudience(int $id)
    {
        $audience = Audience::findOrFail($id);
        return $audience->delete();
    }
}
