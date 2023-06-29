<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClient extends FormRequest
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
            'username' => 'required|string|unique:clients',
            'email'    => 'required|email|unique:clients',
            'password' => 'required|string',
            'cpassword' => 'string',
            'raison_sociale' => 'required|string',
            'contact' => 'required|string',
            'pays' => 'required|string',
            'num_client' => 'string'
        ];
    }
}