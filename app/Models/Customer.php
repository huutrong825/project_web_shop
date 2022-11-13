<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;

    protected $table='customer';

    protected $fillable=[
        'customer_name',
        'email',
        'phone',
        'address'
    ];

    protected $primaryKey = 'customer_id';
    protected $dates =['deleted_at'];

    public function order()
    {
        return $this->hasMany(Order::class, 'customer_id', 'customer_id');
    }
}
