<?php

namespace App\Helpers;
use Carbon\Carbon;

/**
 * Класс ChangeDateAndTimeHelper.
 *
 * Помощник для работы с датами и временем.
 */
class ChangeDateAndTimeHelper
{
    /**
     * Список месяцев для конвертации даты.
     */
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

    /**
     * Изменяет формат даты и времени.
     *
     * @param Carbon $dateTime Объект даты и времени.
     * @return string Возвращает отформатированную строку даты и времени.
     */
    public static function changeFormatDateAndTime($dateTime)
    {
        //$carbonDate = Carbon::parse($dateTime); // Преобразование строки в объект Carbon
        $formattedDate = $dateTime->format('d.m.Y H:i:s'); // Форматирование в российский стандарт
        return $formattedDate;
    }

    /**
     * Изменяет формат даты.
     *
     * @param Carbon $date Объект даты.
     * @return string Возвращает отформатированную строку даты.
     */
    public static function changeFormatDate($date)
    {
        //$carbonDate = Carbon::parse($dateTime); // Преобразование строки в объект Carbon
        $formattedDate = $date->format('d.m.Y'); // Форматирование в российский стандарт
        return $formattedDate;
    }

    /**
     * Изменяет формат даты для документа.
     *
     * @param Carbon $date Объект даты.
     * @return array Возвращает отформатированные день, месяц и год.
     */
    public static function changeDateForDocument($date)
    {
        setlocale(LC_TIME, 'ru_RU.utf8');
        $day = $date->day;
        $month = self::$monthsList[$date->format('m')]; // Полное название месяца
        $year = $date->format('y'); // Двузначный год
        return [$day, $month, $year];
    }

    /**
     * Изменяет формат даты для имени файла.
     *
     * @param Carbon $date Объект даты.
     * @return string Возвращает отформатированную строку даты подходящую для имени файла.
     */
    public static function changeFormatDateForNameFile($date)
    {
        //$carbonDate = Carbon::parse($dateTime); // Преобразование строки в объект Carbon
        $formattedDate = $date->format('d_m_Y'); // Форматирование в российский стандарт
        return $formattedDate;
    }
}
