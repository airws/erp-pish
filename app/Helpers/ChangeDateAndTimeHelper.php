<?php

namespace App\Helpers;
use Carbon\Carbon;

class ChangeDateAndTimeHelper
{
    private static array $monthsList = array(
        "01" => "января",
        "02" => "февраля",
        "03" => "марта",
        "04" => "апреля",
        "05" => "мая",
        "06" => "июня",
        "07" => "июля",
        "08" => "августа",
        "09" => "сентября",
        "10" => "октября",
        "11" => "ноября",
        "12" => "декабря"
    );


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
        $month = self::$monthsList[$date->format('m')]; // Полное название месяца
        $year = $date->format('y'); // Двузначный год
        return [$day, $month, $year];
    }

    public static function changeFormatDateForNameFile($date)
    {
        //$carbonDate = Carbon::parse($dateTime); // Преобразование строки в объект Carbon
        $formattedDate = $date->format('d_m_Y'); // Форматирование в российский стандарт
        return $formattedDate;
    }




}