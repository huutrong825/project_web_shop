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
        $cate=Category::where('category_id', $id)->get();
        if ($cate) {
            return response()->json(
                [
                'status'=>200,
                'cate'=>$cate
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

    public function addCate(Request $req)
    {
        $cate = Category::create(
            [
                'category_name' => $req->cate_name,
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
        $cate = Category::where('category_id', $id)-> first();
        $cate->delete();
        return response()->json(
            [
                'status' => 200,
                'message' => "Xóa thành công"
            ]
        );
    }

    public function updateCate(Request $req, $id)
    {
        $cate = Category::where('category_id', $id);
        $cate->update(
            [
                'category_name' => $req -> cate_nameUp
            ]
        );
        return response()->json(
            [
                'status' => 200,
                'message' => "Cập nhật thành công"
            ]
        );
    }
}
