<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'genre', 'duration', 'description','poster'];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
