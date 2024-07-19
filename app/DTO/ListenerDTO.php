<?php
// app/DTOs/PayerDetailDTO.php
namespace App\DTO;

use App\Models\Orders\PayerDetail;

class ListenerDTO
{
    private int $bidId = 0;
    private bool $avalibleVoSpo = false;
    private string $fio = '';
    private string $phone = '';
    private string $email = '';
    private string $snils = '';
    private int $groupProgramId = 0;
    private string $servicesId = '';

    /**
     * @return int
     */
    public function getBidId(): int
    {
        return $this->bidId;
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
    public function getFio(): string
    {
        return $this->fio;
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
     * @return int
     */
    public function getGroupProgramId(): int
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



    public function __construct(array $data)
    {
        $this->bidId = $data['bid_id'];
        $this->avalibleVoSpo = $data['avalible_vo_spo'];
        $this->fio = $data['fio'];
        $this->phone = $data['phone'];
        $this->email = $data['email'];
        $this->snils = $data['snils'];
        $this->groupProgramId = $data['group_program_id'];
        $this->servicesId = $data['services_id'];
    }
}
