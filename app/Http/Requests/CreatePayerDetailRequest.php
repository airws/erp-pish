<?php
// app/Http/Requests/CreatePayerDetailRequest.php
namespace App\Http\Requests;

use App\Models\Orders\PayerDetail;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CreatePayerDetailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        switch ($request->type_face) {
            case PayerDetail::TYPE_FACE['FIZ']:
            {
                return [
                    'order_id' => 'required|integer',
                    'bik_bank' => 'required|string',
                    'name_bank' => 'required|string',
                    'rc' => 'required|string',
                    'ks' => 'required|string',
                    'kbk' => 'required|string',
                    'personal_account' => 'required|string',
                    'actual_address' => 'required|string',
                    'type_face' => ['required', Rule::in(PayerDetail::TYPE_FACE)],
                    'surname' => 'sometimes|string',
                    'name' => 'sometimes|string',
                    'patronymic' => 'sometimes|string',
                    'snils' => 'sometimes|string',
                    'registration_address' => 'sometimes|string',
                ];
            }
            case PayerDetail::TYPE_FACE['UR']:
            case PayerDetail::TYPE_FACE['IP']:
            {
                return [
                    'order_id' => 'required|integer',
                    'bik_bank' => 'required|string',
                    'name_bank' => 'required|string',
                    'rc' => 'required|string',
                    'ks' => 'required|string',
                    'kbk' => 'required|string',
                    'personal_account' => 'required|string',
                    'actual_address' => 'required|string',
                    'ur_address' => 'required|string',
                    'type_face' => ['required', Rule::in(PayerDetail::TYPE_FACE)],
                    'inn' => 'sometimes|string',
                    'kpp' => 'sometimes|string',
                    'ogrn' => 'sometimes|string',
                    'city' => 'sometimes|string',
                    'index' => 'sometimes|string',
                    'abbreviation' => 'sometimes|string',
                    'full_ur_name' => 'sometimes|string',
                    'fio_rod_head' => 'sometimes|string',
                    'fio_head' => 'sometimes|string',
                    'job_title' => 'sometimes|string',
                    'acts_basis' => 'sometimes|string',
                    'concluded_accordance' => 'sometimes|string',
                ];
            }
            default:
            {
                return ['type_face' => ['required', Rule::in(PayerDetail::TYPE_FACE)]];
            }
        }
    }
}