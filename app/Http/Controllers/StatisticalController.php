<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Charts\MyChart;

class StatisticalController extends Controller
{
    public function overview_index()
    {
        $myChart = new MyChart;
        $myChart->labels(['1','2','3']);
        $myChart->dataset('Text', 'line', [10,25,14])
            ->color("rgb(255, 99, 132)")
            ->backgroundcolor("rgb(255, 99, 132)");

        return view('Admin.Statistical.overview_index', compact('myChart'));
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

        

        $order = Order::where('state', 5)->
        select(
            'order_date',
            'total_price'
        )->get();

        

        

        

        return response()->json(
            [
                'array' => $array,
                'order' => $order,
            ]
        );
    }

    public function order_statis()
    {
        return view('Admin.Statistical.order_index');
    }
}
