<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Cus extends Model
{
    use HasFactory;

    protected $table='user_cus';

    protected $fillable=[
        'name',
        'email',
        'password',
        'avatar',
        'sex',
        'phone',
        'birth',
        'address',
        'last_login_at',
    ];
}
