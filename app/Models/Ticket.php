<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => true,
        'type' => 'technique'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_id',
        'client_id',
        'type',
        'objet',
        'status'
    ];

    public function service() {
        return $this->belongsTo('App\Models\Service');
    }

    public function client() {
        return $this->belongsTo('App\Models\Client');
    }

     public function messages() {
        return $this->hasMany('App\Models\TicketMessage');
    }

}
