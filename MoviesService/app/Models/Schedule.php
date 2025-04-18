<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['movie_id', 'theater', 'show_time', 'price'];

    // Relasi: Schedule milik satu Movie
    public function movie()
    {   
        return $this->belongsTo(Movie::class);
    }
}
