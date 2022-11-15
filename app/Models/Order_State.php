<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order_State extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='order_state';

    protected $fillable=[
        'state_name'
    ];

    protected $dates =['deleted_at'];

    public function order()
    {
        return $this->hasMany(Order::class, 'state', 'id');
    }
}
