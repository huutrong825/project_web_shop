<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    
    public function getLogin()
    {
        return view('Auth.login');
    }

    public function postLogin(LoginRequest $req)
    {
        $remember = $req->customCheck;
        try {

            if (Auth::viaRemember()) {
                return redirect('/admin');
            } else if (Auth::attempt(['email'=>$req->email, 'password'=>$req->password, 'is_active' => 1], $remember)) {
                Auth::user()->update(
                    [
                        'last_login_at' => date('Y-m-d H:i:s')
                    ]
                );
                return redirect('/admin');
            } else {
                return redirect('/login')->with('error', 'Email hoặc mật khẩu không đúng');
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function getRegister()
    {
        return view('Auth.register');
    }

    public function postRegister(Request $req)
    {

        $u = User::create(
            [
                'name' => $req->txtname,
                'email' => $req->email,
                'password' => Hash::make($req->repass),            
                'remember_token' => Str::random(10),
                'is_active'=> 1,
                'is_delete'=> 0,
                'group_role'=> 1,
                'last_login_at' => date('Y-m-d H:i:s'),
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
            $id = Auth::id();
            $user = DB::table('users')->where('id', $id)->get();
        }
        return view('Admin.profile', compact('user'));
    }

    public function updateProfile(Request $req)
    {
        
        $id = Auth::id();
        $user = User::find($id);
        $img_name = '';
        
        if ($req->file('avatar')) {

            $this->validate(
                $req, 
                [
                    'avatar' => 'mimes:jpg,jpeg,png,gif'
                ],
                [
                    
                    'avatar.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
                ]
            );
            if ($req->file('avatar')->isValid()) {
                $img = $req->avatar;
                $img_name = $img->getClientOriginalName();
                $img->move(public_path('img'), $img_name);  
            }
        }
        if ($req->checkPass != 'on') {

            if ($img_name != null) {
                $user->update(
                    [
                        'name' => $req->name,
                        'sex' => $req->sex,
                        'phone' => $req->phone,
                        'birth' => $req->birth,
                        'address' => $req->address,
                        'avatar' => $img_name
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
                    ]
                );
            }
        }
        return back()->with('thongbao', 'Cập nhật thành công');
    }

    public function changePass(Request $req)
    {
               
        if (Auth::attempt(['email'=>$req->mail, 'password'=>$req->password])) {
            if ($req->newpass == $req->repass) {
                
                Auth::user()->update(
                    [
                        'password' => Hash::make($req->repass)
                    ]
                );
            }
            return response()->json(
                [
                    'state' => 200,
                    'messages' => 'Lưu thành công'
                ]
            );
        } else {
            return response()->json(
                [
                    'state' => 402,
                    'messages' => 'Mật khẩu sai'
                ]
            );
        }
    }
}
