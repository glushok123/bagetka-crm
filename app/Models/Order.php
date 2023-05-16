<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'client_name',
        'client_phone',
        'payment_method',
        'status_materials',
        'payment_status',
        'date_reception',
        'date_issuance',
        'prepayment',
        'total_amount',
        'delivery',
        'comment',
        'created_at',
        'updated_at',
    ];

}
