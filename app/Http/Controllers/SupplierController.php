<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

/**
 * Description class
 * 
 * @author    Mr <dang.trong.rcvn2012@gmail.com>
 * @copyright 2022  dang.trong.rcvn2012@gmail.com
 * @link      h
 */
class SupplierController extends Controller
{
    public function index()
    {
        return view('Admin.Supplier.supplier_list');
    }
    /**
     * Get data from table doing.
     * 
     * @return     supp
     * @author     Mr <dang.trong.rcvn2012@gmail.com>
     * @lastupdate trong.dang
     */
    public function getSupplier()
    {
        $supp = Supplier::all();
        return Datatables::of($supp)->
            addColumn(
                'is_state', function ($supp) {
                    $temp = $supp->is_state == 0 ? '<td><span style="color:red">Ngừng cung ứng</span></td>'
                            :($supp->is_state == 1 ? '<td><span style="color:green">Đang cung ứng</span></td>'
                            :'Errol');
                    return $temp;
                }
            )
            ->addColumn(
                'action', function ($supp ) {
                    return '<a value="'. $supp->id. '" class="btn btn-success btn-circle btn-sm bt-Update">
                    <i class="fas fa-pen"></i>
                    </a>
                    <a value=" '. $supp->id .'" class="btn btn-danger btn-circle btn-sm bt-Delete" >
                        <i class="fas fa-trash"></i>
                    </a>
                    <a value=" '. $supp->id .'" class="btn btn-warning btn-circle btn-sm bt-Block">
                        <i class="fas fa-user-times"></i>
                    </a>';
                }
            )
            ->rawColumns(['is_state','action'])
            ->make(true);
    }

    public function getIDSupplier($id)
    {        
        $supp=DB::table('supplier')->where('id', $id)->get();

        if ($supp) {
            return response()->json(
                [
                    'status' => 200,
                    'supp' => $supp
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
     * Thêm nhà cung ứng
     * 
     * @return     supp
     * @author     Mr <dang.trong.rcvn2012@gmail.com>
     * @lastupdate dang.trong
     */

    /** 
     * Thêm nhà cung ứng
     * 
     * @param string $req  
     * 
     * @return supp
     */
    public function postAddSupplier(Request $req)
    {
        
        if ($req->is_state) {   
            $sta = 1 ;
        } else {
            $sta = 0 ;
        }

        $supp = Supplier::create(
            [
                'supplier_name' => $req->name_sup,
                'address' => $req->address,
                'phone' => $req->phone,
                'is_state' => $sta
            ]
        );
        $supp->save();
        return response()->json(
            [
                'status' => 200,
                'message' => "Thêm thành công"
            ]
        );
        
    }

    /**
     * Xóa nhà cung ứng
     * 
     * @return     supp
     * @author     Mr <dang.trong.rcvn2012@gmail.com>
     * @lastupdate dang.trong
     */

    /** 
     * Xóa nhà cung ứng
     * 
     * @param int $id  
     * 
     * @return supp
     */
    public function deleteSupplier($id)
    {
        Supplier::find($id)->delete();

        return response()->json(
            [
                'status'=>200,
                'message'=>"Xóa thành công"
            ]
        );
    }

    /**
     * Cập nhật trạng thái cung ứng
     * 
     * @return     supp
     * @author     Mr <dang.trong.rcvn2012@gmail.com>
     * @lastupdate dang.trong
     */

    /** 
     * Cập nhật trạng thái cung ứng
     * 
     * @param int $id 
     * 
     * @return supp
     */
    public function blockSupplier($id)
    {
        
        $suppBlock = Supplier::where('id', $id)->first();
        if ($suppBlock) {
            if ($suppBlock->is_state == 1) {
                $suppBlock ->update(
                    [
                        'is_state'=>0
                    ]
                );
            } else {
                $suppBlock->update(
                    [
                        'is_state'=>1
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
     * Cập nhật nhà cung ứng
     * 
     * @return     supp
     * @author     Mr <dang.trong.rcvn2012@gmail.com>
     * @lastupdate dang.trong
     */

    /** 
     * Cập nhật nhà cung ứng
     * 
     * @param string $req 
     * @param int    $id 
     * 
     * @return supp
     */
    public function UpdateSupp(Request $req,$id)
    {
        $supp=Supplier::where('id', $id)->first();
                
        $supp->update(
            [
            'supplier_name'=>$req->nameUp,
            'address'=>$req->addressUp,
            'phone'=>$req->phoneUp,
            ]
        );

        return response()->json(
            [
                'status'=>200,
                'mess'=>'Thành công'
            ]
        );
    }
}
