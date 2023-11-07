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

    public static function changeFormatDate($date)
    {
        //$carbonDate = Carbon::parse($dateTime); // Преобразование строки в объект Carbon
        $formattedDate = $date->format('d.m.Y'); // Форматирование в российский стандарт
        return $formattedDate;
    }

    public static function changeDateForDocument($date)
    {
        setlocale(LC_TIME, 'ru_RU.utf8');
        $day = $date->day;
        $month = $date->format('F'); // Полное название месяца
        $year = $date->format('y'); // Двузначный год
        echo "<pre>";
        var_dump($day);
        var_dump($month);
        var_dump($year);
        echo "</pre>";
        die();
        return [$day, $month, $year];
    }

}