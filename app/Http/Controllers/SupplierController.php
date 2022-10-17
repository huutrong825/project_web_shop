<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function getList(){
        $supp=Supplier::all();
        return view('Admin.Supplier.supplier_list',compact('supp'));
    }

    public function postAddSupplier(Request $req){
        if($req->state)
            $sta=1;
        else
            $sta=0;

        $supp=Supplier::create([
            'supplier_name'=>$req->txtname,
            'address'=>$req->address,
            'phone'=>$req->phone,
            'is_state'=>$sta
        ]);

        $supp->save();
        return redirect('/admin/supplier')->with('thongbao','Đã thêm thành công');
        
    }

    public function deleteSupplier($id){
        Supplier::where('id',$id)->delete();
        return back()->with('thongbao','Đã xóa');
    }

    public function blockSupplier($id){

        $supp=Supplier::find($id);

        if($supp->is_state==1){
            $supp->update([
                'is_state'=>0
            ]);
        }
        else{
            $supp->update([
                'is_state'=>1
            ]);
        }

        return redirect('/admin/supplier')->with('thongbao','Đã lưu thay đổi');
    }

    public function getFix($id){
        $supp=Supplier::where('id',$id)->first();

        return view('Admin.Supplier.fix_user',compact('supp'));
    }

    public function postFix(Request $req,$id)
    {
        $supp=Supplier::where('id',$id)->first();
                
         $supp->update([
            'supplier_name'=>$req->txtname,
            'address'=>$req->address,
            'phone'=>$req->phone,
        ]);

        return back()->with('thongbao','Đã lưu');
    }
}
