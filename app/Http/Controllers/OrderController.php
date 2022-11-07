<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_Detail;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        return view('Admin.Order.list_order');
    }

    public function listOrder()
    {
        $o = DB::table('order')
            ->join('customer', 'order.customer_id', '=', 'customer.customer_id')
            ->join('order_state', 'order.state', '=', 'order_state.id')
            ->select(
                'order_id', 
                'customer_name',
                'order_date',
                'receive_date',
                'type_payment',
                'total_price',
                'state_name'
            );
        $o->get();

        return Datatables::of($o)->
        addColumn(
            'customer_name', function ($o) {
                return '<a value=" '. $o->order_id .'" class="btDetail">' . $o->customer_name .'</a>';
            }
        )
        ->addColumn(
            'type_payment', function ($o) {
                $temp= $o->type_payment == 1 ? 'Chuyển khoản' :' COD ';
                return $temp;
            }
        )
        ->rawColumns(['customer_name'])
        ->make(true);
    }
    
    public function detail($id)
    {
        $detail = Order::join('order_detail', 'order.order_id', '=', 'order_detail.order_id')
            ->join('product', 'product.product_id', '=', 'order_detail.product_id')
            ->where('order.order_id', $id)
            ->select(
                'product_name',
                'quanity_order',
                'price',
            )->get();

        return Datatables::of($detail)->make(true);

        // $order = Order::join('customer', 'order.customer_id', '=', 'customer.customer_id')
        //     ->where('order.order_id', $id)
        //     ->select(
        //         'customer_name',
        //         'address',
        //         'total_price'
        //     )->get();
        // return response()->json(
        //     [
        //         'order' => $order,
        //         'detail' => $detail
        //     ]
        // );
    }
}
