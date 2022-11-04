<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='unit';

    protected $fillable=[
        'unit_name',
    ];

    protected $dates = ['deleted_at'];

    public function product()
    {
        return $this->hasMany(Product::class, 'unit', 'id');
    }
}
