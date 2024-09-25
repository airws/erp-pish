<?php
// app/DTOs/PayerDetailDTO.php
namespace App\DTO;

use App\Models\Orders\PayerDetail;

class ListenerDTO
{
    private int $bidId = 0;
    private int $listenerId = 0;
    private bool $avalibleVoSpo = false;
    private string $surname = '';
    private string $name = '';
    private string $patronymic = '';
    private string $phone = '';
    private string $email = '';
    private string $snils = '';
    private array $groupProgramId = [];
    private string $servicesId = '';

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPatronymic(): string
    {
        return $this->patronymic;
    }

    /**
     * @return int
     */
    public function getBidId(): int
    {
        return $this->bidId;
    }

    /**
     * @return int
     */
    public function getListenerId(): int
    {
        return $this->listenerId;
    }

    /**
     * @return bool
     */
    public function isAvalibleVoSpo(): bool
    {
        return $this->avalibleVoSpo;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getSnils(): string
    {
        return $this->snils;
    }

    /**
     * @return array
     */
    public function getGroupProgramId(): array
    {
        return $this->groupProgramId;
    }

    /**
     * @return array
     */
    public function getServicesId(): array
    {
        return $this->servicesId;
    }


    /**
     * Создание нового экземпляра класса.
     *
     * @param array $data Массив данных. Ожидает следующие ключи:
     *   'bid_id' - идентификатор ставки,
     *   'avalible_vo_spo' - доступность ВО/СПО,
     *   'fio' - ФИО,
     *   'phone' - телефон,
     *   'email' - электронная почта,
     *   'snils' - СНИЛС,
     *   'group_program_id' - массив идентификаторов групповой программы,
     *   'services_id' - идентификаторы услуг.
     */

    public function __construct(array $data)
    {
        $this->bidId = $data['bid_id'];
        $this->listenerId = $data['listener_id']?:0;
        $this->avalibleVoSpo = $data['avalible_vo_spo'];
        $this->surname = $data['surname'];
        $this->name = $data['name'];
        $this->patronymic = $data['patronymic'];
        $this->phone = $data['phone'];
        $this->email = $data['email'];
        $this->snils = $data['snils'];
        $this->groupProgramId = $data['group_program_id'];
        //$this->servicesId = $data['services_id'];
    }
}
