<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table='discount';

    protected $fillable=[
        'dis_name',
        'type_disc',
        'value',
        'start_day',
        'end_day',
        'is_state',
        'is_delete'
    ];
    
    protected $primaryKey = 'dis_id';
}
