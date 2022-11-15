<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='order';

    protected $fillable=[
        'customer_id',
        'order_date',
        'cancel_date',
        'receive_date',
        'type_payment',
        'total_price',
        'description',
        'state',
        'reason_cancel'
    ];

    protected $dates =['deleted_at'];

    protected $primaryKey = 'order_id';

    public function history()
    {
        return $this->hasOne(Order_History::class);
    }

    public function state()
    {
        return $this->belongsTo(Order_State::class, 'state', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }
}
