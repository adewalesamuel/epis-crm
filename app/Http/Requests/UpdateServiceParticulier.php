<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceParticulier extends FormRequest
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
           'designation_spe' => 'required|string',
           'prix_est' => 'required|string',
           'periodicite' => 'required|integer',
           'condition_acq' => 'string',
       ];
   }
}
