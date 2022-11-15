<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product_Img extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='product_img';

    protected $fillable=[
        'product_id',
        'img_url'
    ];

    protected $dates =['deleted_at'];
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
