<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='discount';

    protected $fillable=[
        'dis_name',
        'type_disc',
        'value',
        'start_day',
        'end_day',
        'is_state',
    ];

    protected $dates =['deleted_at'];
    
    protected $primaryKey = 'dis_id';
}
