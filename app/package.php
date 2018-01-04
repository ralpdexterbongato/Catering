<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class package extends Model
{
  public function company()
  {
    return $this->belongsTo('App\company');
  }
  public function products()
  {
    return $this->belongsToMany('App\Product','product_packages','package_id','product_id');
  }
}
