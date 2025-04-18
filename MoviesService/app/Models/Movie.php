<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi
    protected $fillable = ['title', 'genre', 'duration', 'description','poster'];

    // Relasi: Movie punya banyak Schedule
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
