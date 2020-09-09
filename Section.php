<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'sections';

    protected $fillable = ['name','description','logo','user_id'];

 /**
    * Получить пользователя, владеющего данным телефоном.
    */
  public function user()
  {
    return $this->belongsTo('App\User');
  }

  

}
