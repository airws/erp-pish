<?php

namespace App\Http\Requests;

use App\Models\Orders\PayerDetail;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CreateListener extends FormRequest
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
        return [
            'bid_id' => 'required|exists:bids,id',
            'avalible_vo_spo' => 'required|boolean',
            'fio' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'snils' => 'required|max:12',
            'group_program_id' => 'required',
            'services_id' => 'required',
        ];
    }
}