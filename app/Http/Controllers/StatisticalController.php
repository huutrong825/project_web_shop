<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Models\Product;
use App\Models\Product_Add;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Charts\MyChart;

class StatisticalController extends Controller
{
    public function overview_index()
    {
        
        return view('Admin.Statistical.overview_index');
    }

    public function data()
    {
        $store = DB::table('product')->sum('quanity');    //hàng trong kho

        $sum_total = Order::where('state', 5)->sum('total_price'); //doanh thu bán

        $sum_order = Order::count('order_id');

        $cancel_order = Order::where('state', 6)->count('order_id');

        $complete_order = Order::where('state', 5)->count('order_id');

        $sum_sale = Order_Detail::rightJoin('order', 'order.order_id', '=', 'order_detail.order_id')    //số luongj bán
            ->where('state', 6)->sum('quanity_order');

        $product_add = Product_Add::sum('quanity_add');

        $pro = Product_Add::select('quanity_add', 'price', 'date_add')->get();
        $fee_add =  0;
        foreach ($pro as $p) {
            $fee_add += $p->quanity_add * $p->price;
        }

        $array = [
            'store' => $store, 
            'sum_total' => $sum_total,
            'sum_order' => $sum_order ,
            'cancel_order' => $cancel_order, 
            'complete_order' => $complete_order,
            'sum_sale' => $sum_sale,
            'product_add' => $product_add,
            'fee_add' => $fee_add
        ];

        

        $order = Order::where('state', 5)->
        selectRaw(
            'date(order_date) as order_date,
            total_price'
        )->get();

        
        
        foreach ($order as $o) {
            $data[] =  $o->total_price;
            $date[] = $o->order_date;              
        }

        $prod = DB::table('product_add')->        
        selectRaw(
            'date(date_add) as date_add,
            sum(quanity_add) as quanity,
            sum(price) as sum_price'
        )->groupBy('date_add')->get();

        
        foreach ($prod as $p) {
            $date_add[] = $p->date_add;
            $sum_quanity[] = $p->quanity;
            $sum_price[] = $p->sum_price;
        }
        return response()->json(
            [
                'array' => $array,
                'data' => $data,
                'date' => $date,
                'date_add' => $date_add,
                'sum_quanity' => $sum_quanity,
                'sum_price' => $sum_price
            ]
        );
    }

    public function order_statis()
    {
        return view('Admin.Statistical.order_index');
    }

    public function order_product()
    {
        
        $sum_order = Order::sum('order_id');

        $sum_prod = Order_Detail::rightJoin('order', 'order.order_id', '=', 'order_detail.order_id')    //số luongj bán
            ->where('state', 6)->sum('quanity_order');

        $num_prod = DB::table('order_detail')->distinct()->count('product_id');

        $data_order = [
            'sum_order' => $sum_order,
            'sum_prod' => $sum_prod,
            'num_prod' => $num_prod 
        ];

        $order = DB::table('order')->
        join('order_state', 'order.state', '=', 'order_state.id')
            ->selectRaw(
                'count(order_id) as count,
                state_name,
                order_state.id'
            )->groupBy('state_name', 'order_state.id')->orderBy('order_state.id')->get();

        
        foreach ($order as $o) {
            $state[] =  $o->state_name;
            $count[] = $o->count;              
        }

        return response()->json(
            [
                'data' => $data_order,
                'stated' => $state,
                'count' => $count,
            ]
        );
    }
}
