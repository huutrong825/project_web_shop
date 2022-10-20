<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table='supplier';

    protected $fillable=[
        'supplier_name',
        'phone',
        'address',
        'is_state'
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'supplier_id', 'id');
    }
}
