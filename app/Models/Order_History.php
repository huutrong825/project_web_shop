<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order_History extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='order_history';

    protected $fillable=[
        'cus_id',
        'order_id',
        'state_order'
    ];

    protected $dates =['deleted_at'];
}
