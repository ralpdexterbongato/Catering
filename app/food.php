<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class food extends Model
{
  public function prices()
  {
    return $this->hasMany('App\price');
  }
}
