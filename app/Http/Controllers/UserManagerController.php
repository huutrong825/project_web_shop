<?php

/**
 * Description function
 *
 * @package    App
 * @subpackage Controllers
 * @author     "Mr <dang.trong.rcvn2012@gmail.com>
 * @copyright  2022  dang.trong.rcvn2012@gmail.com
 * 
 */ 
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AddUserRequest;
use Illuminate\Support\Facades\Hash;
use Validator;

/**
 * Description class
 * 
 * @author    Mr <dang.trong.rcvn2012@gmail.com>
 * @copyright 2022  dang.trong.rcvn2012@gmail.com
 * @link      h
 */
class UserManagerController extends Controller
{
    /** 
     * Lấy danh sách user từ sever
     */  

    /**
     * Get data from table doing.
     * 
     * @return     string response
     * @author     Mr <dang.trong.rcvn2012@gmail.com>
     * @lastupdate dang.trong
     */
    public function listUser()
    {
        $user = User::orderBy('id', 'desc')->search()->paginate(10);

        return view('Admin.User.user_list', compact('user'));
    }

    
    /**
     * Get data from table doing.
     * 
     * @return     string response
     * @author     Mr <dang.trong.rcvn2012@gmail.com>
     * @lastupdate dang.trong
     */

    /** 
     * Delete user
     * 
     * @param string $req  
     * 
     * @return user
     */ 
    public function postAddUser(Request $req)
    {
        $vali=Validator::make(
            $req->all(),
            [
                'name'=>'required|min:5',
                'email'=>'required|unique:users|',
                'password'=>'required|min:6|',
                'repass'=>'required|same:password',
                'group_role'=>'required'
            ],
            [
                'name.required'=>'Tên không được trống',
                'name.min'=>'Tên không được nhỏ hơn :min ký tự',
                'email.required'=>'Email không được trống',
                'email.unique'=>'Email đã tồn tại',
                'password.required'=>'Mật khẩu không được trống',
                'password.min'=>'Mật khẩu không được nhỏ hơn :min ký tự',
                'repass.required'=>'Mật khẩu xác nhận không được trống',
                'repass.same'=>'Mật khẩu xác nhận chưa đúng',
                'group_role.required'=>'Chưa chọn nhóm người dùng',
            ]
        );

        if ($vali->fails())
        {
            return response()->json(
                [
                'status'=>400,
                'errors'=>$vali->messages()
                ]
            );
        }
        else
        {
            if($req->active)
            {   
                $act = 1 ;
            }
            else
            {
                $act=0 ;
            }
            $user = User::create(
                [
                    'name'=>$req->name,
                    'email'=>$req->email,
                    'password'=>Hash::make($req->repass),
                    'group_role'=>$req->group_role,
                    'is_active'=>$act
                ]
            );
            $user->save();
            return response()->json(
                [
                'status'=>200,
                'message'=>"Thêm thành công"
                ]
            );
        
        }
    }
    

    /**
     * Get data from table doing.
     * 
     * @return     string user
     * @author     Mr <dang.trong.rcvn2012@gmail.com>
     * @lastupdate dang.trong
     */

    /** 
     * Delete user
     * 
     * @param int $id 
     * 
     * @return user
     */  
    public function deleteUser($id)
    {
        $userDel = User::where('id', $id)->first();
        if ($userDel)
        {
            $userDel->delete();
            return response()->json(
                [
                'status'=>200,
                'mess'=>'Thành công'
                ]
            );
        }
        else
        {
            return response()->json(
                [
                'status'=>404,
                'mess'=>'Not find'
                ]
            );
        }
    }

     

    /**
     * Get data from table doing.
     * 
     * @return     string user
     * @author     Mr <dang.trong.rcvn2012@gmail.com>
     * @lastupdate dang.trong
     */

    /** 
     * Block or open  user's status
     * 
     * @param int $id 
     * 
     * @return $user
     */
    public function blockUser($id)
    {
        $userBlock = User::where('id', $id)->first();
        if ($userBlock)
        {
            if ($userBlock->is_active == 1)
            {
                $userBlock ->update(
                    [
                    'is_active'=>0
                    ]
                );
            }
            else
            {
                $userBlock->update(
                    [
                    'is_active'=>1
                    ]
                );
            }
                return response()->json(
                    [
                    'status'=>200,
                    'mess'=>'Thành công'
                    ]
                );
        }
        else
        {
            return response()->json(
                [
                'status'=>404,
                'mess'=>'Not find'
                ]
            );
        }
        
    }

    

    /**
     * Get data from table doing.
     * 
     * @return     string response
     * @author     Mr <dang.trong.rcvn2012@gmail.com>
     * @lastupdate dang.trong
     */

    /** 
     * Get Update user
     * 
     * @param $id 
     * 
     * @return respotion
     */ 
    public function getUser($id)
    {        
        $userUp = User::where('id', $id)->first();
        if ($userUp)
        {
            return response()->json(
                [
                'status'=>200,
                'user'=>$userUp
                ]
            );
        }
        else
        {
            return response()->json(
                [
                'status'=>404,
                'mess'=>'Not find'
                ]
            );
        }
    }


    /**
     * Get data from table doing.
     * 
     * @return     string response
     * @author     Mr <dang.trong.rcvn2012@gmail.com>
     * @lastupdate dang.trong
     */

    /** 
     * Update user
     * 
     * @param string $req 
     * @param int    $id    
     *  
     * @return reposetion
     */  
    public function putUpdateUser(Request $req, $id)
    {
        $vali=Validator::make(
            $req->all(),
            [                        
                'password'=>'required|min:6|',
                'newpass'=>'required|min:6|',
                'renewpass'=>'required|same:newpass',
            ],
            [
                'password.required'=>'Mật khẩu không được trống',
                'password.min'=>'Mật khẩu không được nhỏ hơn :min ký tự',
                'newpass.required'=>'Mật khẩu mới không được trống',
                'newpass.min'=>'Mật khẩu không được nhỏ hơn :min ký tự',
                'renewpass.required'=>'Mật khẩu xác nhận không được trống',
                'renewpass.same'=>'Mật khẩu xác nhận lại chưa đúng',
            ]
        );

        $userUp = User::where('id', $id)->first();

        if ($userUp)
        {
            if ($req->checks == false)
            {                
                $userUp->update(
                    [
                    'name'=>$req->names,
                    'group_role'=>$req->group_roles,
                    ]
                );
                
                return response()->json(
                    [
                    'status'=>200, 
                    'mess'=>'Success Update'
                    ]
                );
            }
            else
            {
                if ($vali->fails())
                {
                    return response()->json(
                        [
                        'status'=>412,
                        'errors'=>$vali->messages()
                        ]
                    );
                }
                else
                {                
                    $userUp->update(
                        [
                        'name'=>$req->names,
                        'group_role'=>$req->group_roles,
                        'password'=>Hash::make($req->renewpass),
                        ]
                    );

                    return response()->json(
                        [
                        'status'=>200, 
                        'mess'=>'Success Update'
                        ]
                    );
                }
            } 
        }
        else
        {
            return response()->json(
                [
                'status'=>400,
                'errors'=>'Not find'
                ]
            );
        }
    }
}
