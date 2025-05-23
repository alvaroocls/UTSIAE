<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'movie_id',
        'theater_id',
        'quantity',
        'total_price',
    ];
}
