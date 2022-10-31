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
        $cate = Category::all();

        return Datatables::of($cate)
            ->addColumn(
                'action', function ($cate) {
                    return '<a value="' . $cate->category_id . '" class="btn btn-success btn-circle btn-sm bt-Update">
                    <i class="fas fa-pen"></i></a>            

                    <a value="' . $cate->category_id . '" class="btn btn-danger btn-circle btn-sm bt-Delete">
                    <i class="fas fa-trash"></i></a>';
                }
            )
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getCateId($id)
    {
        $cate=Category::where('cate_id', $id)->get();

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

    public function addCate(Request $req)
    {
        if ($req->image) {
            $img_name = $req->image->getClientOriginalName();
            $req->image->move(public_path('img'), $img_name);
        }
        $cate = Category::create(
            [
                'cate_name' => $req->cate_name,
            ]
        );
        $cate->save();
        return response()->json(
            [
                'state' => 200,
                'messages' => 'Thành công'
            ]
        );
    }
    public function deleteCate($id)
    {
        Category :: where('category_id', $id)-> delete();

        return response()->json(
            [
                'status' => 200,
                'message' => "Xóa thành công"
            ]
        );
    }

    public function updateCate(Request $req,$id)
    {
        
        
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
