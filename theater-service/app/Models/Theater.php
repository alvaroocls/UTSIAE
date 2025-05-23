<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    protected $fillable = ['name', 'location'];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}

