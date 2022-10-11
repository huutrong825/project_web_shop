<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table='admin_user';

    protected $fillable=[
        'name',
        'email',
        'password',
        'avatar',
        'sex',
        'phone',
        'birth',
        'address',
        'is_active',
        'group_role',
        'last_login_at',
    ];
}
