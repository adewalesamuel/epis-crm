<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAbonnementHebergement extends FormRequest
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
            'service_id' => 'required|string',
            'client_id' => 'required|string',
            'domaine' => 'nullable|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'prix' => 'required|integer',
        ];
    }
}
