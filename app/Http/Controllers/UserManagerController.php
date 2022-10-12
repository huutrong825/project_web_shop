<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserManagerController extends Controller
{
    public function listAdmin(){

        $admin=DB::table('users')->orderBy('id','desc')->get();

        return view('Admin.User.user_list',compact('admin'));
    }

    public function postAddUser(Request $req){
        
    }
}
