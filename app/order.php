<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
  public function user()
  {
    return $this->belongsTo('App\User');
  }
  public function colors()
  {
    return $this->belongsToMany('App\CompanyColor','order_colors','order_id','color_id');
  }
  public function foods()
  {
    return $this->belongsToMany('App\food','food_orders','order_id','food_id');
  }
  public function getCreatedAtAttribute($date)
  {
     return Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans();
  }
}
