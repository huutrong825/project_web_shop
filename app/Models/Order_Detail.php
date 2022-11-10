<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order_Detail extends Model
{
    use HasFactory;

    protected $table='order_detail';

    protected $fillable=[
        'order_id',
        'product_id',
        'quanity_order',
        'price',
        'discount'
    ];

    protected $dates =['deleted_at'];
}
