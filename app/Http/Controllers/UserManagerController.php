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
use Yajra\Datatables\Datatables;

/**
 * Description class
 * 
 * @author    Mr <dang.trong.rcvn2012@gmail.com>
 * @copyright 2022  dang.trong.rcvn2012@gmail.com
 * @link      h
 */
class UserManagerController extends Controller
{

    public function index()
    {
        return view('Admin.User.user_list');
    }
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
    public function listUser(Request $req)
    {
        
        if (request()->ajax()) {
            if (!empty($req->group) && empty($req->active)) {
                $user = User::where('group_role', $req->group)         
                            ->get();
            } else if (empty($req->group) && !empty($req->active)) {
                $user = User::where('is_active', $req->active)      
                            ->get();
            } else if (!empty($req->group) && !empty($req->active)) {
                $user = User::where('group_role', $req->group) 
                            ->where('is_active', $req->active)   
                            ->get();
            } else {
                $user = User::all();
            }
        }
        return Datatables::of($user)->
        addColumn(
            'group_role', function ($user) {
                $temp = $user->group_role == 1? "Admin" : ($user->group_role == 2? "Employee" : "Errol");
                return $temp;
            }
        )
        ->addColumn(
            'is_active', function ($user) {
                $temp = $user->is_active == 1? '<span style="color:green">Đang hoạt động</span>' : '<span style="color:red">Ngưng hoạt động</span>';
                return $temp;
            }
        )
        ->addColumn(
            'action', function ($user) {
                return '<a value="'. $user->id .'" class="btn btn-success btn-circle btn-sm bt-Update">
                <i class="fas fa-pen"></i></a>
                
                <a value="'. $user->id .'" class="btn btn-danger btn-circle btn-sm bt-Delete">
                <i class="fas fa-trash"></i></a> 

                <a value="'. $user->id .'" class="btn btn-warning btn-circle btn-sm bt-Block">
                <i class="fas fa-user-times"></i></a>';
            }
        )
        ->rawColumns(['group_role','is_active','action'])
        ->make();
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
        if ($req->active) {   
            $act = 1 ;
        } else {
            $act=0 ;
        }
        $user = User::create(
            [
                'name' => $req->name,
                'email' => $req->email,
                'password' => Hash::make($req->repass),
                'group_role' => $req->group_role,
                'is_active' =>$act
            ]
        );
        $user->save();
        return response()->json(
            [
                'status' => 200,
                'message' => "Thêm thành công"
            ]
        );
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
        if ($userDel) {
            $userDel->delete();
            return response()->json(
                [
                    'status' => 200,
                    'mess' => 'Thành công'
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'mess' => 'Not find'
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
        if ($userBlock) {
            if ($userBlock->is_active == 1) {
                $userBlock ->update(
                    [
                    'is_active'=>0
                    ]
                );
            } else {
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
        } else {
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
        if ($userUp) {
            return response()->json(
                [
                'status'=>200,
                'user'=>$userUp
                ]
            );
        } else {
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
        $userUp = User::where('id', $id)->first();
        if ($userUp) {
            if ($req->checks == false) {                
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
            } else {
                if ($vali->fails()) {
                    return response()->json(
                        [
                        'status'=>412,
                        'errors'=>$vali->messages()
                        ]
                    );
                } else {                
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
        } else {
            return response()->json(
                [
                'status'=>400,
                'errors'=>'Not find'
                ]
            );
        }
    }

}
