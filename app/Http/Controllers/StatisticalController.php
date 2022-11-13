<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_Detail;

class StatisticalController extends Controller
{
    public function overview_index()
    {
        return view('Admin.Statistical.overview_index');
    }

    public function data()
    {
        $quanity = DB::table('product')->sum('quanity');    //hàng trong kho

        $sum_total = Order::where('state', 5)->sum('total_price'); //doanh thu bán

        $sum_order = Order::count('order_id');

        $cancel_order = Order::where('state', 5)->count('order_id');

        $complete_order = Order::where('state', 6)->count('order_id');

        $sum_sale = Order_Detail::rightJoin('order', 'order.order_id', '=', 'order_detail.order_id')    //số luongj bán
            ->where('state', 6)->sum('quanity_order');

        $array = [
            'quanity' => $quanity, 
            'sum_total' => $sum_total,
            'sum_order' => $sum_order ,
            'cancel_order' => $cancel_order, 
            'complete_order' => $complete_order,
            'sum_sale' => $sum_sale
        ];

        $order = Order::where('state', 5)->select('date(order_date)', 'total_price')->get();
        dd($order);

        return response()->json(
            [
                'array' => $array,
            ]
        );
    }
}
