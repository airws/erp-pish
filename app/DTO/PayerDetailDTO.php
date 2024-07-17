<?php
// app/DTOs/PayerDetailDTO.php
namespace App\DTO;

use App\Models\Orders\PayerDetail;

class PayerDetailDTO
{
    private int $order_id = 0;
    private string $bik_bank = '';
    private string $name_bank = '';
    private string $rc = '';
    private string $ks = '';
    private string $kbk = '';
    private string $personal_account = '';
    private string $actual_address = '';
    private string $ur_address = '';
    private string $type_face = '';
    private string $inn = '';
    private string $kpp = '';
    private string $ogrn = '';
    private string $city = '';
    private string $index = '';
    private string $abbreviation = '';
    private string $full_ur_name = '';
    private string $fio_rod_head = '';
    private string $fio_head = '';
    private string $job_title = '';
    private string $acts_basis = '';
    private string $concluded_accordance = '';
    private string $surname = '';
    private string $name = '';
    private string $patronymic = '';
    private string $snils = '';
    private string $registration_address = '';

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->order_id;
    }

    /**
     * @return string
     */
    public function getBikBank(): string
    {
        return $this->bik_bank;
    }

    /**
     * @return string
     */
    public function getNameBank(): string
    {
        return $this->name_bank;
    }

    /**
     * @return string
     */
    public function getRc(): string
    {
        return $this->rc;
    }

    /**
     * @return string
     */
    public function getKs(): string
    {
        return $this->ks;
    }

    /**
     * @return string
     */
    public function getKbk(): string
    {
        return $this->kbk;
    }

    /**
     * @return string
     */
    public function getPersonalAccount(): string
    {
        return $this->personal_account;
    }

    /**
     * @return string
     */
    public function getActualAddress(): string
    {
        return $this->actual_address;
    }

    /**
     * @return string
     */
    public function getUrAddress(): string
    {
        return $this->ur_address;
    }

    /**
     * @return string
     */
    public function getTypeFace(): string
    {
        return $this->type_face;
    }

    /**
     * @return string
     */
    public function getInn(): string
    {
        return $this->inn;
    }

    /**
     * @return string
     */
    public function getKpp(): string
    {
        return $this->kpp;
    }

    /**
     * @return string
     */
    public function getOgrn(): string
    {
        return $this->ogrn;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getIndex(): string
    {
        return $this->index;
    }

    /**
     * @return string
     */
    public function getAbbreviation(): string
    {
        return $this->abbreviation;
    }

    /**
     * @return string
     */
    public function getFullUrName(): string
    {
        return $this->full_ur_name;
    }

    /**
     * @return string
     */
    public function getFioRodHead(): string
    {
        return $this->fio_rod_head;
    }

    /**
     * @return string
     */
    public function getFioHead(): string
    {
        return $this->fio_head;
    }

    /**
     * @return string
     */
    public function getJobTitle(): string
    {
        return $this->job_title;
    }

    /**
     * @return string
     */
    public function getActsBasis(): string
    {
        return $this->acts_basis;
    }

    /**
     * @return string
     */
    public function getConcludedAccordance(): string
    {
        return $this->concluded_accordance;
    }

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
     * @return string
     */
    public function getSnils(): string
    {
        return $this->snils;
    }

    /**
     * @return string
     */
    public function getRegistrationAddress(): string
    {
        return $this->registration_address;
    }

    public function __construct(array $data)
    {
        switch ($data['type_face']) {
            case PayerDetail::TYPE_FACE['FIZ']:
            {
                $this->order_id = $data['order_id'];
                $this->bik_bank = $data['bik_bank'];
                $this->name_bank = $data['name_bank'];
                $this->rc = $data['rc'];
                $this->ks = $data['ks'];
                $this->kbk = $data['kbk'];
                $this->personal_account = $data['personal_account'];
                $this->actual_address = $data['actual_address'];
                $this->type_face = $data['type_face'];
                $this->surname = $data['surname'];
                $this->name = $data['name'];
                $this->patronymic = $data['patronymic'];
                $this->snils = $data['snils'];
                $this->registration_address = array_key_exists('registration_address', $data)?$data['registration_address']:'';
                break;
            }
            case PayerDetail::TYPE_FACE['IP']:
            case PayerDetail::TYPE_FACE['UR']:
            {
                $this->order_id = $data['order_id'];
                $this->bik_bank = $data['bik_bank'];
                $this->name_bank = $data['name_bank'];
                $this->rc = $data['rc'];
                $this->ks = $data['ks'];
                $this->kbk = $data['kbk'];
                $this->personal_account = $data['personal_account'];
                $this->actual_address = $data['actual_address'];
                $this->type_face = $data['type_face'];
                $this->ur_address = $data['ur_address'];
                $this->inn = $data['inn'] ?? null;
                $this->kpp = $data['kpp'] ?? null;
                $this->ogrn = $data['ogrn'] ?? null;
                $this->city = $data['city'] ?? null;
                $this->index = $data['index'] ?? null;
                $this->abbreviation = $data['abbreviation'] ?? null;
                $this->full_ur_name = $data['full_ur_name'] ?? null;
                $this->fio_rod_head = $data['fio_rod_head'] ?? null;
                $this->fio_head = $data['fio_head'] ?? null;
                $this->job_title = $data['job_title'] ?? null;
                $this->acts_basis = $data['acts_basis'] ?? null;
                $this->concluded_accordance = $data['concluded_accordance'] ?? null;
                break;
            }

        }
    }
}
