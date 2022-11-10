<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Models\Discount;
use App\Models\Product;

class DiscountController extends Controller
{
    public function index()
    {
        $disc = Discount::all();

        $pro = Product::all();
        return view('Admin.Discount.discount', compact('disc', 'pro'));
    }

    public function listDis()
    {
        $dis = Discount::all();
        return Datatables::of($dis)->
        addColumn(
            'type_disc', function ($dis) {
                $temp = $dis->type_disc == 1 ? 'Giảm theo % giá trị' :
                ( $dis->type_disc == 2 ? 'Giảm theo số tiền' : 'Sản phẩm tặng kèm');

                return $temp;
            }
        )
        ->addColumn(
            'value', function ($dis) {
                $temp = $dis->type_disc == 1 ? $dis->value .'%' :$dis->value .' vnđ';
                return $temp;
            }
        )
        ->addColumn(
            'is_state', function ($dis) {
                $temp = $dis->is_state == 1 ? '<span style="color:green">Đang chạy</span>' :
                '<span style="color:red"> Kết thúc </span>';
                return $temp;
            }
        )
        ->addColumn(
            'action', function ($dis) {
                return '<a value="'. $dis->dis_id .'" class="btn btn-success btn-circle btn-sm bt-Update">
                <i class="fas fa-pen"></i></a>
                
                <a value="'. $dis->dis_id .'" class="btn btn-danger btn-circle btn-sm bt-Delete">
                <i class="fas fa-trash"></i></a> 

                <a value="'. $dis->dis_id .'" class="btn btn-warning btn-circle btn-sm bt-Block">
                <i class="fas fa-lock"></i></a>';
            }
        )
        ->rawColumns(['type_disc','value', 'is_state', 'action'])->make(true);
    }

    public function addDis(Request $req)
    {
        Discount::create(
            [
                'dis_name' => $req->namedis,
                'type_disc' =>$req->typedis,
                'value' => $req->value,
                'start_day' => $req->startday,
                'end_day' => $req->endday,
                'is_state' => 1
            ]
        );
        return response()->json(
            [
                'state' =>200,
                'messages' =>'Thêm thành công'
            ]
        );
    }

    public function getDis($id)
    {
        $dis = Discount::where('dis_id', $id)->get();
        return response()->json(
            [
                'dis' => $dis
            ]
        );
    }

    public function updateDis(Request $req, $id)
    {
        $dis = Discount::where('dis_id', $id);
        $dis->update(
            [
                'dis_name' => $req->nameUp,
                'type_disc' =>$req->typedisUp,
                'value' => $req->valueUp,
                'start_day' => $req->startdayUp,
                'end_day' => $req->enddayUp,
            ]
        );
        return response()->json(
            [
                'state' =>200,
                'messages' =>'Cập nhật thành công'
            ]
        );
    }

    public function blockDis($id)
    {
        $disblock = Discount::where('dis_id', $id)->first();
        if ($disblock) {
            if ($disblock->is_state == 1) {
                $disblock->update(
                    [
                        'is_state' => 0
                    ]
                );
            } else {
                $disblock->update(
                    [
                        'is_state' => 1
                    ]
                );
            }
            return response()->json(
                [
                    'state' =>200,
                    'messages' =>'Cập nhật thành công'
                ]
            );
        } else {
            return response()->json(
                [
                    'state' =>404,
                    'messages' =>'không tìm thấy'
                ]
            );
        }
    }
    public function deleteDis($id)
    {
        $dis = Discount::where('dis_id', $id)->first();
        $dis->delete();
        return response()->json(
            [
                'state' =>200,
                'messages' =>'Xóa thành công'
            ]
        );
    }
    
    public function linkPro(Request $req)
    {
        $pro = Product::where('product_id', $req->product)->first();
        $pro->update(
            [
                'discount_id' => $req->namedis
            ]
        );

        return response()->json(
            [
                'messages' => 'Thành công'
            ]
        );
    }
}
