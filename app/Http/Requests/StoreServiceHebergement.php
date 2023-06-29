<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceHebergement extends FormRequest
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
            'periodicite' => 'required|integer',
            'condition_acq' => 'string',
            'esp_disq' => 'required|string',
            'nbr_mails' => 'required|integer',
            'nbr_bds' => 'required|integer',
            'mem_ram' => 'required|string',
            'sys_ex' => 'required|string',
            'panel_admin' => 'required|string',
            'esp_back' => 'required|string',
            'band_pass' => 'required|string',
            'type_serv' => 'required|string'
        ];
    }
}
