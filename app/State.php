<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public function cities()
    {
        return $this->hasMany(City::class, 'states_id', 'id');
    }
}
