<?php

/**
 * Description function
 *
 * @package    App
 * @subpackage Controllers
 * @author     "Mr <tronghuu.dang825@gmail.com>
 * @copyright  2022  tronghuu.dang825@gmail.com
 * 
 */ 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

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
        $supp=Supplier::all();
        return response()->json(
            [
                'supp'=>$supp
            ]
        );
    }

    public function getIDSupplier($id)
    {        
        $supp=DB::table('supplier')->where('id', $id)->get();

        if ($supp)
        {
            return response()->json(
                [
                'status'=>200,
                'supp'=>$supp
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
        
        if($req->is_state)
        {   
            $sta = 1 ;
        }
        else
        {
            $sta = 0 ;
        }

        $supp=Supplier::create(
            [
            'supplier_name'=>$req->name_sup,
            'address'=>$req->address,
            'phone'=>$req->phone,
            'is_state'=>$sta
            ]
        );
        $supp->save();
        return response()->json(
            [
            'status'=>200,
            'message'=>"Thêm thành công"
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
        if ($suppBlock)
        {
            if ($suppBlock->is_state == 1)
            {
                $suppBlock ->update(
                    [
                        'is_state'=>0
                    ]
                );
            }
            else
            {
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
    public function getFix($id)
    {
        $supp = Supplier::where('id', $id)->first();

        return view('Admin.Supplier.fix_user', compact('supp'));
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
    public function postFix(Request $req,$id)
    {
        $supp=Supplier::where('id', $id)->first();
                
        $supp->update(
            [
            'supplier_name'=>$req->txtname,
            'address'=>$req->address,
            'phone'=>$req->phone,
            ]
        );

        return back()->with('thongbao', 'Đã lưu');
    }
}
