<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'category';

    protected $fillable = [
        'category_name',
    ];

    protected $dates =['deleted_at'];

    protected $primaryKey = 'category_id';

    public function product()
    {
        $this->hasMany(Product::class, 'category_id', 'category_id');
    }
}
