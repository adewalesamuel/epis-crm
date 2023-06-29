<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{   
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'designation',
        'designation_spe', 
        'prix_est',
        'details',
        'condition_acq',
        'periodicite'
    ];

    public function abonnements() {
        return $this->hasMany('App\Models\Abonnement');
    }

    public function commandes() {
        return $this->hasMany('App\Models\Commande');
    }

}
