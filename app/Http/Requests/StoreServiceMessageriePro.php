<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceMessageriePro extends FormRequest
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
            'designation_spe' => 'required|string|unique:services',
            'prix_est' => 'required|string',
            'type' => 'string',
            'periodicite' => 'required|integer',
            'condition_acq' => 'string',
        ];
    }
}
