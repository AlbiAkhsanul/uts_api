<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePartnerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'nama_partner' => 'sometimes|required|string|max:255',
            'negara_asal' => 'sometimes|required|string|max:2',
            'email' => 'sometimes|required|email|unique:partners,email,' . $this->route('partner'),
            'no_telepon' => 'sometimes|required|string|max:20',
        ];
    }
}
