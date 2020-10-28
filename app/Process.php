<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Process extends Model
{
    use SoftDeletes;

    public function customer() {
        return $this->hasMany('App\Customer', 'id');
    }

    public function address() {
        return $this->hasMany('App\Address', 'id');
    }
    
    public function process_photos() {
        return $this->hasMany('App\ProcessPhotos', 'processes_id');
    }
    
    public function process_logs() {
        return $this->hasMany('App\ProcessLog', 'processes_id');
    }

    public function cities_p() {
        return $this->hasOneThrough('App\Address', 'App\Customer', 'id', 'customers_id', 'id', 'id');
    }

    public function user_name() {
        return $this->belongsTo('App\User', 'id');
    }
}
