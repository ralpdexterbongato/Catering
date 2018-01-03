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
  public function products()
  {
    return $this->belongsToMany('App\Product','product_orders','order_id','product_id');
  }
  public function getCreatedAtAttribute($date)
  {
     return Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans();
  }
  public function getDateStartAttribute($date)
  {
     return Carbon::createFromFormat('Y-m-d', $date)->format('Y/m/d');
  }
  public function getDateAttribute($date)
  {
     return Carbon::createFromFormat('Y-m-d', $date)->format('Y/m/d');
  }
  public function getNotificationTimeAttribute($date)
  {
     return Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans();
  }
  private function setDateStartValue($value) {
    $date_parts = explode('/', $value);
    $this->attributes['start_date'] = $date_parts[2].'-'.$date_parts[0].'-'.$date_parts[1];
  }
  public function company()
  {
    return $this->belongsTo('App\company');
  }
}
