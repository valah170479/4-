<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
/**
   * Получить запись с номером телефона пользователя.
   */
    public function section() {
return $this->hasMany('App\Section');
}

public function user()
  {
    return $this->belongsTo('App\Portfolio');
  }

     protected $table = 'users'; 
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','admin', 'password',
        'images','video','section_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
