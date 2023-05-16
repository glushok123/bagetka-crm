<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'orders_id',
        'article_baget',
        'chop',
        'window_size',
        'article_kanta',
        'article_pasp',
        'field_width',
        'quantity',
        'amount',
        'created_at',
        'updated_at',
    ];
}
