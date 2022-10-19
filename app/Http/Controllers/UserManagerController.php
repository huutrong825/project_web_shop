<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AddUserRequest;
use Illuminate\Support\Facades\Hash;

class UserManagerController extends Controller
{
    public function listUser(){

        $user=User::orderBy('id','desc')->search()->paginate(10);

        return view('Admin.User.user_list',compact('user'));
    }

    // public function getAddUser(){
        
    //     return view('Admin.User.add_user');
    // }

    public function postAddUser(AddUserRequest $req){

        if($req->active)
            $act=1;
        else
            $act=0;

        $user=User::create([
            'name'=>$req->txtname,
            'email'=>$req->email,
            'password'=>Hash::make($req->repass),
            'group_role'=>$req->group_role,
            'is_active'=>$act
        ]);
        $user->save();
        return redirect('/admin/user')->with('thongbao','Đã thêm thành công');
        
    }

    public function deleteUser( $id){
        User::where('id',$id)->delete();
        return back()->with('thongbao','Đã xóa');
    }

    public function blockUser($id){

        $user=User::find($id);

        if($user->is_active==1){
            $user->update([
                'is_active'=>0
            ]);
        }
        else{
            $user->update([
                'is_active'=>1
            ]);
        }

        return redirect('/admin/user')->with('thongbao','Đã lưu thay đổi');
    }

    public function getUpdateUser($id){
        
        $userUp=User::where('id',$id)->first();
        if ($userUp)
        {
            return response()->json([
                'status'=>200,
                'user'=>$userUp
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'mess'=>'Not find'
            ]);
        }
    }

    public function putUpdateUser(Request $req,$id)
    {
        $userUp=User::where('id',$id)->first();
        if ($userUp )
        {
            if ($req->checks!=true){                
                $userUp->update([
                    'name'=>$req->names,
                    'group_role'=>$req->group_roles,
                    ]);                          
            }
            else{
                $this->validate($req,[
                    
                    'password'=>'required|min:6|',
                    'newpass'=>'required|min:6|',
                    'renewpass'=>'required|same:newpass',
                ],[
                    'password.required'=>'Mật khẩu không được trống',
                    'password.min'=>'Mật khẩu không được nhỏ hơn :min ký tự',
                    'newpass.required'=>'Mật khẩu mới không được trống',
                    'newpass.min'=>'Mật khẩu không được nhỏ hơn :min ký tự',
                    'renewpass.required'=>'Mật khẩu xác nhận không được trống',
                    'renewpass.same'=>'Mật khẩu xác nhận lại chưa đúng',
                ]);

                $userUp->update([
                    'name'=>$req->names,
                    'group_role'=>$req->group_roles,
                    'password'=>Hash::make($req->renewpass),
                ]);  
            }
        return response()->json([
        'status'=>200, 
        'mess'=>'Success Update'
        ]);  

        }else{
            return response()->json([
                'status'=>400,
                'mess'=>'Not find'
            ]);
        }
    }
}
