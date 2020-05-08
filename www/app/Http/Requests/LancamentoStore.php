<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LancamentoStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "boleta" => "required",
            "romaneio" => "required",
            "data_compra" => "required",
            "data_vencimento" => "required",
            "valor" => "required",
            "cliente" => "required",
            "loja" => "required",
        ];
    }
}
