<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function address() {
        return $this->hasOne('App\Address', 'customers_id');
    }

    public function process() {
        return $this->hasMany('App\Process', 'customers_id');
    }
}
