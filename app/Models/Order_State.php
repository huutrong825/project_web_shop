<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_State extends Model
{
    use HasFactory;

    protected $table='order_state';

    protected $fillable=[
        'state_order'
    ];

    public function order(){
        return $this->hasMany(Order::class,'state','id');
    }
}
