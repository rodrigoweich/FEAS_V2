<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    public function user() {
        return $this->belongsTo('App\User', 'users_id');
    }
}
