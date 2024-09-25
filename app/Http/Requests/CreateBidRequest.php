<?php

namespace App\Http\Requests;

use App\Models\Orders\PayerDetail;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CreateBidRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /** TODO order_id мб не известен, в случае создание заказа в одной форме*/
        return [
            'order_id' => 'required|exists:orders,id',
            'program_id' => 'required|exists:programs,id',
            'user_id' => 'sometimes|required|exists:users,id',
            'fio[]' => 'sometimes|required',
            'email[]' => 'sometimes|required|email',
            'phone[]' => 'sometimes|required',
            'snils[]' => 'sometimes|required',
            'avalible_vo_spo[]' => 'sometimes|required|boolean',
            //'group_program_id' => 'required|exists:group_programs,id',
        ];
    }
}