<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_State;
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
        $state = Order_State::all();
        $o = DB::table('order')
            ->join('customer', 'order.customer_id', '=', 'customer.customer_id')
            ->join('order_state', 'order.state', '=', 'order_state.id')
            ->select(
                'order_id', 
                'customer_name',
                'order_date',
                'receive_date',
                'cancel_date',
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

    public function processIndex()
    {
        return view('Admin.Order.processing_order');
    }

    public function processOrder()
    {
        $state = Order_State::all();
        $o = DB::table('order')
            ->join('customer', 'order.customer_id', '=', 'customer.customer_id')
            ->join('order_state', 'order.state', '=', 'order_state.id')
            ->where('state', '<=', 4)
            ->select(
                'order_id', 
                'customer_name',
                'order_date',
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
        ->addColumn(
            'state_name', function ($o) use ($state) {
                $a = '<select class="form-control filter" id="selecteState" ><option selected value="'. $o->order_id .'">' . $o->state_name .'</option>';
                foreach ($state as $s) {
                    if ($s->id <= 4) {
                        $a .= '<option value="'. $s->id .'">'. $s->state_name .'</option>';
                    }
                }
                $a .= '</select>';
                return $a;
            }
        )
        ->addColumn(
            'action', function ($o) {
                return '<a value=" '. $o->order_id .'" class="btn btn-success btn-sm btState"><i class="fas fa-save"></i></a>';
            }
        )
        ->rawColumns(['customer_name','state_name','action'])
        ->make(true);
    }

    public function completeIndex()
    {
        return view('Admin.Order.order_complete');
    }

    public function orderComplete()
    {
        $state = Order_State::all();
        $o = DB::table('order')
            ->join('customer', 'order.customer_id', '=', 'customer.customer_id')
            ->join('order_state', 'order.state', '=', 'order_state.id')
            ->where('state', '>', 4)
            ->select(
                'order_id', 
                'customer_name',
                'order_date',
                'receive_date',
                'cancel_date',
                'reason_cancel',
                'state_name'
            );
        $o->get();

        return Datatables::of($o)->
        addColumn(
            'customer_name', function ($o) {
                return '<a value=" '. $o->order_id .'" class="btDetail">' . $o->customer_name .'</a>';
            }
        )
        ->rawColumns(['customer_name'])
        ->make(true);
    }
    
    public function infoOrder($id)
    {
        $order = Order::join('customer', 'order.customer_id', '=', 'customer.customer_id')
            ->where('order.order_id', $id)
            ->select(
                'customer_name',
                'order_date',
                'phone',
                'address',
                'email',
                'total_price',
                'description'
            )->get();
        return response()->json(
            [
                'order' => $order
            ]
        );
    }

    public function stateOrder(Request $req, $id)
    {
        $order = Order::where('order_id', $id)->first();
        $order->update(
            [
                'state' => $req->state
            ]
        );
        return response()->json(
            [
                'state' =>200,
                'messages' => "thành công"
            ]
        );
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
        return Datatables::of($detail)->
        addColumn(
            'into_money', function ($detail) {
                $money = $detail->quanity_order * $detail->price;
                return $money;
            }
        )
        ->make(true);
    }

}
