<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class food extends Model
{
  public function company()
  {
    return $this->belongsTo('App\company');
  }
}
