<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceBox extends Model
{
    public function cities()
    {
        return $this->belongsTo(City::class);
    }
}
