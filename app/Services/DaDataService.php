<?php

namespace App\Services;

use Dadata\DadataClient;

/**
 * Служба для работы с API DaData.
 *
 * Этот класс предоставляет методы для получения информации о банках, компаниях и адресах через API DaData.
 */
class DaDataService
{
    private string $token = '';
    private string $secretKey = '';
    private ?DadataClient $daDataClient = null;

    private static ?self $defaultInstance = null;

    /**
     * Конструктор класса.
     *
     * При инициализации класса устанавливаеться токен и секретный ключ из переменных окружения.
     * И создается объект DadataClient.
     */
    public function __construct()
    {
        $this->token = env('DA_DATA_TOKEN');
        $this->secretKey = env('DA_DATA_SECRET_TOKEN');

        $this->daDataClient = new DadataClient($this->token, $this->secretKey);
    }

    /**
     * Получает информацию о банках по BIK.
     *
     * @param string $bik BIK для поиска информации о банке.
     * @return array|null Возвращает информацию о банке или null, если информация не найдена.
     */
    public function getBanksByBik(string $bik)
    {
        //$response = $this->daDataClient->findById("bank", $bik);
        $response = $this->daDataClient->suggest("bank", $bik);

        if (!$response) {
            return null;
        }

        return $response;
    }

    /**
     * Получает информацию о компаниях по ИНН.
     *
     * @param string $inn ИНН для поиска информации о компании.
     * @return array|null Возвращает информацию о компании или null, если информация не найдена.
     */
    public function getCompaniesByInn(string $inn)
    {
        $response = $this->daDataClient->suggest("party", $inn);

        if (!$response) {
            return null;
        }

        return $response;
    }

    /**
     * Получает информацию о компаниях по имени.
     *
     * @param string $name Имя для поиска информации о компании.
     * @return array|null Возвращает информацию о компании или null, если информация не найдена.
     */
    public function getCompaniesByName(string $name)
    {
        $response = $this->daDataClient->suggest("party", $name);

        if (!$response) {
            return null;
        }

        return $response;
    }

    /**
     * Получает информацию об адресах.
     *
     * @param string $address Адрес для поиска информации.
     * @param array $additionalSettings Дополнительные настройки для поиска информации об адресе.
     * @return array|null Возвращает информацию об адресе или null, если информация не найдена.
     */
    public function getAddresses(string $address, array $additionalSettings = [])
    {
        if($additionalSettings) {
            $response = $this->daDataClient->suggest("address", $address, 20, $additionalSettings);
        } else {
            $response = $this->daDataClient->suggest("address", $address, 20);
        }

        if (!$response) {
            return null;
        }

        return $response;
    }
}