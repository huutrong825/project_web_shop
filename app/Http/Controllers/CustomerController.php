<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        return view('Admin.Customer.list_customer');
    }

    public function listCus(Request $req)
    {
        $cus = DB::table('customer');

        if ($req->phone !='') {
            $cus = $cus->where('phone', 'like', '%'. $req->phone .'%');
        }
        if ($req->email !='') {
            $cus = $cus->where('email', 'like', '%'. $req->email .'%');
        }
        if ($req->address !='') {
            $cus = $cus->where('address', 'like', '%'. $req->address .'%');
        }
        if ($req->key !='') {
            $cus = $cus->where('customer_name', 'like', '%'. $req->key .'%');
        }
        $cus->get();

        return Datatables::of($cus)->
        addColumn(
            'action', function ($cus ) {
                return '<a value="'. $cus->customer_id .'" class="btn btn-success btn-circle btn-sm bt-Update">
                <i class="fas fa-pen"></i>
                </a>';
            }
        )
        ->rawColumns(['action'])
        ->make(true);
    }

    public function addCus(Request $req)
    {
        Customer::create(
            [
                'customer_name' => $req->name,
                'email' => $req->email,
                'phone' => $req->phone,
                'address' => $req->address
            ]
        );
        return response()->json(
            [
                'state' => 200,
                'messages' => 'Thêm thành công'
            ]
        );
    }

    public function getId($id)
    {
        $cus = Customer::where('customer_id', $id)->get();
        return response()->json(
            [
                'state' => 200,
                'cus' => $cus
            ]
        );
    }

    public function updateCus(Request $req, $id)
    {
        $cus = Customer::where('customer_id', $id);
        $cus->update(
            [
                'customer_name' => $req->nameUp,
                'email' => $req->emailUp,
                'phone' => $req->phoneUp,
                'address' => $req->addressUp,
            ]
        );
        return response()->json(
            [
                'state' => 200,
                'messages' => 'Cập nhật thành công'
            ]
        );
    }
}
