<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class UnitController extends Controller
{
    public function index()
    {
        return view('Admin.Product.unit');
    }

    public function listUnit()
    {
        $u = Unit::all();
        return Datatables::of($u)->
        addColumn(
            'action', function ($u ) {
                return '<a value="'. $u->unit_id. '" class="btn btn-success btn-circle btn-sm bt-Update">
                <i class="fas fa-pen"></i>
                </a>
                <a value="'. $u->unit_id .'" class="btn btn-danger btn-circle btn-sm bt-Delete" >
                    <i class="fas fa-trash"></i>
                </a>';
            }
        )
        ->rawColumns(['action'])->make(true);
    }

    public function addUnit(Request $req)
    {
        Unit::create(
            [
                'unit_name' => $req->name_unit
            ]
        );
        return response()->json(
            [
                'state'=>200,
                'messages' => 'Thêm thành công'
            ]
        );
    }

    public function getId($id)
    {
        $unit = Unit::where('unit_id', $id)->get();
        return response()->json(
            [
                'state' => 200,
                'uni' => $unit
            ]
        );
    }

    public function deleteUnit($id)
    {
        $unit = Unit::where('unit_id', $id);

        if ($unit) {
            $unit->delete();
            return response()->json(
                [
                'status'=>200,
                'mess'=>'Xóa thành công'
                ]
            );
        } else {
            return response()->json(
                [
                    'status'=>404,
                    'mess'=>'Không tìm thấy'
                ]
            );
        }
    }

    public function updateUnit(Request $req, $id)
    {
        $unit = Unit::where('unit_id', $id);
        $unit->update(
            [
                'unit_name' => $req->unitUp
            ]
        );
        return response()->json(
            [
                'state' => 200,
                'messages' => 'cập nhật thành công'
            ]
        );
    }
}
