<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Authenticatable
{
	use Notifiable;
  use SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'email', 
      'password', 
      'username',
      'raison_sociale',
      'contact',
      'pays',
      'num_client'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'password', 
      'remember_token',
      'password_resets'
  ];

  public function setPasswordAttribute($pass){
      $this->attributes['password'] = Hash::make($pass);
  }

  public function abonnements() {
    return $this->hasMany('App\Models\Abonnement');
  }

  public function commandes() {
      return $this->hasMany('App\Models\Commandes');
  }

  public static function lastNumber (){

    $num = isset(Client::where('id','>', -1)->orderBy('num_client', 'desc')
    ->get()[0]->num_client) ? Client::where('id','>', -1)->orderBy('num_client', 'desc')
    ->get()[0]->num_client+1 : 1;

    return $num ; 
  }

}
