<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Http\Requests\LoginRequest;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function getLogin(){
        return view('login');
    }

    public function postLogin(LoginRequest $req){
        if(Auth::attempt(['email'=>$req->email,'password'=>$req->password]))
        {
            return redirect('/admin');
        }
        else{

            return redirect('/login')->with('thongbao','Đăng nhập không thành công');
        }
    }
    public function getRegister(){

        return view('register');
    }

    public function postRegister(Request $req){

        $u=User::create([
            'name'=>$req->txtname,
            'email'=>$req->email,
            'password'=>Hash::make($req->repass),            
            'remember_token' => Str::random(10),
            'is_active'=>1,
            'is_delete'=>0,
            'group_role'=>1,
            'last_login_at'=>date('Y-m-d H:i:s'),
            'last_login_ip'=>fake()->numerify($string = '###.##.###'),
            'created_at'=>date("Y-m-d"),
            'updated_at'=>date("Y-m-d")
        ]);

        $u->save();

        return redirect('/login');
    }

    public function getLogout(){
        Auth::logout();

        return redirect('/login');
    }

    public function getProfile(){
        if(Auth::check())
        {
            $id=Auth::id();
            $user=User::find($id);
        }

        return view('Admin.profile');
    }
}
