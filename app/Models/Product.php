<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table='product';

    protected $fillable=[
        'product_name',
        'category_id',
        'quanity',
        'unit_price',
        'unit',
        'description',
        'image',
        'discount',
        'supplier_id',
        'is_sale',
        'is_delete'
    ];

    protected $primaryKey = 'product_id';

    

    public function image()
    {
        return $this->hasMany(Product_Img::class, 'product_id', 'product_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function order()
    {
        return $this->belongsToMany(Order::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit', 'id');
    }
}
