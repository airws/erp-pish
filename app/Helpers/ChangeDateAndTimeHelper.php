<?php

namespace App\Helpers;
use Carbon\Carbon;

class ChangeDateAndTimeHelper
{
    public static function changeFormatDateAndTime($dateTime)
    {
        //$carbonDate = Carbon::parse($dateTime); // Преобразование строки в объект Carbon
        $formattedDate = $dateTime->format('d.m.Y H:i:s'); // Форматирование в российский стандарт
        return $formattedDate;
    }
}