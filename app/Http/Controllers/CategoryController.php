<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function getList(){

        $cate=Category::all();

        return view('Admin.Category.list',compact('cate'));
    }

    public function addCategory(Request $req){

        $cate=Category::create([
            'category_name'=>$req->txtname,
            'image'=>$req->email,
        ]);
        $cate->save();
        return redirect('/admin/category')->with('thongbao','Đã thêm thành công');
        
    }

    public function deleteUser($id){
        Category::where('id',$id)->delete();
        return back()->with('thongbao','Đã xóa');
    }

    
    public function getFixCategory($id){
        $cate=Category::where('id',$id)->first();

        return view('Admin.Category.fix_user',compact('cate'));
    }

    public function postFixCategory(Request $req,$id)
    {
        $cate=Category::where('id',$id)->first();
        
        $cate->update([
        'name'=>$req->txtname,
        'image'=>$req->image,
        ]);

        return back()->with('thongbao','Đã lưu');
    }

    public function search(Request $req){       
        if($req>get('search'))
        {
            $search = $req->get('search');
            $user = DB::table('users')
            ->where('name', 'LIKE', "%{$search}%")
            ->get();    
        }      
        return view('Admin.User.user_list',compact('user'));
    }
}
