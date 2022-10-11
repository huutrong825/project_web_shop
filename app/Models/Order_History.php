<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_History extends Model
{
    use HasFactory;

    protected $table='order_history';

    protected $fillable=[
        'cus_id',
        'order_id',
        'state_order'
    ];
}
