<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    public $table = "rules";

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
