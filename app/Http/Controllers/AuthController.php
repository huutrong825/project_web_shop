<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    
    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(LoginRequest $req)
    {
        if (Auth::attempt(['email'=>$req->email, 'password'=>$req->password])) {
            return redirect('/admin');
        } else {
            return redirect('/login')->with('thongbao', 'Email hoặc mật khẩu không đúng');
        }
    }
    public function getRegister()
    {
        return view('register');
    }

    public function postRegister(Request $req)
    {

        $u=User::create(
            [
                'name' => $req->txtname,
                'email' => $req->email,
                'password' => Hash::make($req->repass),            
                'remember_token' => Str::random(10),
                'is_active'=> 1,
                'is_delete'=> 0,
                'group_role'=> 1,
                'last_login_at' => date('Y-m-d H:i:s'),
                'last_login_ip' => fake()->numerify($string = '###.##.###'),
                'created_at' => date("Y-m-d"),
                'updated_at' => date("Y-m-d")
            ]
        );

        $u->save();

        return redirect('/login');
    }

    public function getLogout()
    {
        Auth::logout();

        return redirect('/login');
    }

    public function getProfile()
    {
        if (Auth::check()) {
            $id=Auth::id();
            $user=DB::table('users')->where('id', $id)->get();
        }

        return view('Admin.profile', compact('user'));
    }

    public function updateProfile(Request $req)
    {
        
        $id=Auth::id();
        $user=User::find($id);
        $img_name='';
        
        if ($req->file('avatar')) {
            if ($req->file('avatar')->isValid()) {
                $img=$req->avatar;
                 $img_name=$img->getClientOriginalName();
                 $img->move(public_path('img'), $img_name);              
                
            }
        }
        if ($req->checkPass!='on') {

            if ($img_name!=null) {
                $user->update(
                    [
                    'name'=>$req->name,
                    'sex'=>$req->sex,
                    'phone'=>$req->phone,
                    'birth'=>$req->birth,
                    'address'=>$req->address,
                    'avatar'=>$img_name
                    ]
                );
            } else {
                $user->update(
                    [
                    'name'=>$req->name,
                    'sex'=>$req->sex,
                    'phone'=>$req->phone,
                    'birth'=>$req->birth,
                    'address'=>$req->address,
                    ]
                );
            }
        } else {
            if ($img_name != null) {
                $user->update(
                    [
                        'name' => $req->name,
                        'sex' => $req->sex,
                        'phone' => $req->phone,
                        'birth' => $req->birth,
                        'address' => $req->address,
                        'avatar' => $img_name,
                        'password' => Hash::make($req->repass)
                    ]
                );
            } else {
                $user->update(
                    [
                        'name' => $req->name,
                        'sex' => $req->sex,
                        'phone' => $req->phone,
                        'birth' => $req->birth,
                        'address' => $req->address,
                        'password' => Hash::make($req->repass)
                    ]
                );
            }
        }
        return back()->with('thongbao', 'Cập nhật thành công');
    }
}
