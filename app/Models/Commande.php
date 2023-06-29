<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commande extends Model
{
    use SoftDeletes;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'is_processed' => false,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   protected $fillable = [
       'service_id',
       'client_id', 
       'is_processed',
       'quantite',
       'periode',
       'details'
   ];

    public function service() {
        return $this->belongsTo('App\Models\Service');
    }

     public function client() {
        return $this->belongsTo('App\Models\Client');
    }

}
