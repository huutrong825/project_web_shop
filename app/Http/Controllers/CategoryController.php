<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class CategoryController extends Controller
{
    public function index()
    {
        return view('Admin.Category.list');
    }

    public function getCate()
    {
        $cate=Category::all();

        return Datatables::of($cate)
                ->addColumn('image', function( $cate ) {
                    $url=asset('img/'.$cate->image);
                    return '<img class="avatar" src="' .$url. '" alt="Avatar"
                    style="width:50px;height:50px"/>';
                })
                ->addColumn('action', function($cate) {
                    return '<a value="'.$cate->category_id.'" class="btn btn-success btn-circle btn-sm bt-Update">
                    <i class="fas fa-pen"></i></a>            

                    <a value="'.$cate->category_id.'" class="btn btn-danger btn-circle btn-sm bt-Delete">
                    <i class="fas fa-trash"></i></a>';
                })
                ->rawColumns(['image','action'])
                ->make(true);
    }

    public function getCateId($id)
    {
        $cate=Category::where('category_id', $id)->get();

        if ($cate)
        {
            return response()->json(
                [
                'status'=>200,
                'cate'=>$cate
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

    public function addCate()
    {

    }
    public function deleteCate($id)
    {
        Category:: where('category_id', $id)-> delete();

        return response()->json(
            [
            'status'=>200,
            'message'=>"Xóa thành công"
            ]
        );
    }

    
    public function getFixCategory($id)
    {
        $cate=Category::where('id', $id)->first();

        return view('Admin.Category.fix_user', compact('cate'));
    }

    public function postFixCategory(Request $req,$id)
    {
        $cate=Category::where('id', $id)->first();
        
        $cate->update(
            [
            'name'=>$req->txtname,
            'image'=>$req->image,
            ]
        );

        return back()->with('thongbao', 'Đã lưu');
    }

    public function search(Request $req)
    {       
        if($req>get('search'))
        {
            $search = $req->get('search');
            $user = DB::table('users')->where('name', 'LIKE', "%{$search}%")->get();    
        }      
        return view('Admin.User.user_list', compact('user'));
    }
}
