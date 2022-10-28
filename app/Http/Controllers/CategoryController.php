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
                'image', function ($cate) {
                    $url = asset('img/' . $cate->image);
                    return '<img class="avatar" src="' .$url. '" alt="Avatar"
                    style="width:50px;height:50px"/>'; 
                }
            )
            ->addColumn(
                'action', function ($cate) {
                    return '<a value="' . $cate->category_id . '" class="btn btn-success btn-circle btn-sm bt-Update">
                    <i class="fas fa-pen"></i></a>            

                    <a value="' . $cate->category_id . '" class="btn btn-danger btn-circle btn-sm bt-Delete">
                    <i class="fas fa-trash"></i></a>';
                }
            )
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

    public function addCate(Request $req)
    {
        if ($req->image) {
            $img_name = $req->image->getClientOriginalName();
            $req->image->move(public_path('img'), $img_name);
        }
        $cate = Category::create(
            [
                'category_name' => $req->cate_name,
                'image' => $img_name,
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
        // $cate = Category::where('category_id', $id)->first();
        // if ($req->image) {
        //     $cate->update(
        //         [
        //             'category_name'=>$req->cate_nameUp,
        //             'image'=>$req->imageUp,
        //         ]
        //     );
        // } else {
        //     $cate->update(
        //         [
        //             'category_name'=>$req->cate_nameUp,
        //         ]
        //     );
        // }
        // $cate->save();
        dd($req->imageUp->getClientOriginalName());
        // return response()->json(
        //     [
        //         'status' => 200,
        //         'req' => $req->all()
        //     ]
        // );
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
