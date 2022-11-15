<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product_Add extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='product_add';

    protected $fillable=[
        'pro_id',
        'quanity_add',
        'price',
        'date_add',
    ];

    protected $dates =['deleted_at'];
}
