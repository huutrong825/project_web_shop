<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='supplier';

    protected $fillable=[
        'supplier_name',
        'phone',
        'address',
        'is_state',
    ];

    protected $dates =['deleted_at'];

    public function product()
    {
        return $this->hasMany(Product::class, 'supplier_id', 'id');
    }
}
