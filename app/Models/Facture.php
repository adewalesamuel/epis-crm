<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facture extends Model
{
     use SoftDeletes;

     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
    protected $fillable = [
        'ref',
        'abonnement_id'
    ];

    public function abonnement() {
         return $this->belongsTo('App\Models\Abonnement');
    }

}
