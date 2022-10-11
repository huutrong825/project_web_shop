<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table='order';

    protected $fillable=[
        'customer_id',
        'order_date',
        'receive_date',
        'type_payment',
        'total_price',
        'description',
        'state'
    ];

    public function history(){
        return $this->hasOne(Order_History::class);
    }

    public function state(){
        return $this->belongsTo(Order_State::class,'state','id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','customer_id');
    }

    public function product(){
        return $this->belongsToMany(Product::class);
    }
}
