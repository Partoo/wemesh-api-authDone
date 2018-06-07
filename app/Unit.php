<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $guarded = [
        'id'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
