<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Abonnement extends Model
{   
    use SoftDeletes;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'is_resil' => false,
        'is_renouv' => false
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_id',
        'client_id',
        'libelle',
        'date_debut',
        'date_fin',
        'prix',
        'details',
        'is_renouv',
        'is_resil',
        'is_deleted'
    ];

    public function service() {
        return $this->belongsTo('App\Models\Service');
    }

    public function client() {
        return $this->belongsTo('App\Models\Client');
    }

    public function factures() {
        return $this->hasMany('App\Models\Facture');
    }

}
