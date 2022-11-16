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
use Carbon\Carbon;

class StatisticalController extends Controller
{
    public function overview_index()
    {
        
        return view('Admin.Statistical.overview_index');
    }

    public function data(Request $req)
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $startOfMonth = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()
            ->toDateString();
        $startLastMonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()
            ->toDateString();
        $endLastMonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()
            ->toDateString();
        
        $sub7day = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $sub365day = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
        
        $store = DB::table('product')->sum('quanity');    //hàng trong kho

        $sum_total = Order::where('state', 5)
            ->whereBetween('order_date', [$startOfMonth, $now])
            ->sum('total_price'); //doanh thu bán

        $sum_order = Order::whereBetween('order_date', [$startOfMonth, $now])->count('order_id');

        $cancel_order = Order::where('state', 6)
            ->whereBetween('order_date', [$startOfMonth, $now])
            ->count('order_id');

        $complete_order = Order::where('state', 5) 
            ->whereBetween('order_date', [$startOfMonth, $now])
            ->count('order_id');

        $sum_sale = Order_Detail::rightJoin('order', 'order.order_id', '=', 'order_detail.order_id')    //số luongj bán
            ->where('state', 5)->whereBetween('order_date', [$startOfMonth, $now])
            ->sum('quanity_order');

        $product_add = Product_Add::whereBetween('date_add', [$startOfMonth, $now])->sum('quanity_add');

        $pro = Product_Add::whereBetween('date_add', [$startOfMonth, $now])->select('quanity_add', 'price', 'date_add')->get();
        $fee_add =  0;
        foreach ($pro as $p) {
            $fee_add += $p->quanity_add * $p->price;
        }

        $prod = DB::table('product_add')->whereBetween('date_add', [$startOfMonth, $now])
            ->selectRaw(
                'date(date_add) as date_add,
                sum(quanity_add) as quanity,
                sum(price) as sum_price'
            )->groupBy('date_add')->orderBy('date_add')->get();
            
        $order = Order::where('state', 5)
            ->whereBetween('order_date', [$startOfMonth, $now])
            ->selectRaw('date(order_date) as order_date,total_price')
            ->orderBy('order_date')->get();
            
        if ($req->time == '7ngay') {            

            $sum_total = Order::where('state', 5)
                ->whereBetween('order_date', [$sub7day, $now])
                ->sum('total_price'); //doanh thu bán

            $sum_order = Order::whereBetween('order_date', [$sub7day, $now])
                ->count('order_id');

            $cancel_order = Order::where('state', 6)
                ->whereBetween('order_date', [$sub7day, $now])
                ->count('order_id');

            $complete_order = Order::where('state', 5)
                ->whereBetween('order_date', [$sub7day, $now])
                ->count('order_id');

            $sum_sale = Order_Detail::rightJoin('order', 'order.order_id', '=', 'order_detail.order_id')    //số luongj bán
                ->where('state', 5)->whereBetween('order_date', [$sub7day, $now])
                ->sum('quanity_order');

            $product_add = Product_Add::whereBetween('date_add', [$sub7day, $now])
                ->sum('quanity_add');

            $pro = Product_Add::whereBetween('date_add', [$sub7day, $now])
                ->select('quanity_add', 'price', 'date_add')->get();
            $fee_add =  0;
            foreach ($pro as $p) {
                $fee_add += $p->quanity_add * $p->price;
            }

            $prod = DB::table('product_add')
                ->whereBetween('date_add', [$sub7day, $now])
                ->selectRaw(
                    'date(date_add) as date_add,
                    sum(quanity_add) as quanity,
                    sum(price) as sum_price'
                )->groupBy('date_add')->orderBy('date_add')->get();

            $order = Order::where('state', 5)
                ->whereBetween('order_date', [$sub7day, $now])
                ->selectRaw('date(order_date) as order_date,total_price')
                ->orderBy('order_date')->get();

        } elseif ($req->time == 'thangtruoc') {
            $sum_total = Order::where('state', 5)
                ->whereBetween('order_date', [$startLastMonth, $endLastMonth])
                ->sum('total_price'); //doanh thu bán

            $sum_order = Order::whereBetween('order_date', [$startLastMonth, $endLastMonth])
                ->count('order_id');

            $cancel_order = Order::where('state', 6)
                ->whereBetween('order_date', [$startLastMonth, $endLastMonth])
                ->count('order_id');

            $complete_order = Order::where('state', 5)
                ->whereBetween('order_date', [$startLastMonth, $endLastMonth])
                ->count('order_id');

            $sum_sale = Order_Detail::rightJoin('order', 'order.order_id', '=', 'order_detail.order_id')    //số luongj bán
                ->where('state', 5)->whereBetween('order_date', [$startLastMonth, $endLastMonth])
                ->sum('quanity_order');

            $product_add = Product_Add::whereBetween('date_add', [$startLastMonth, $endLastMonth])
                ->sum('quanity_add');

            $pro = Product_Add::whereBetween('date_add', [$startLastMonth, $endLastMonth])
                ->select('quanity_add', 'price', 'date_add')->get();
            $fee_add =  0;
            foreach ($pro as $p) {
                $fee_add += $p->quanity_add * $p->price;
            }

            $prod = DB::table('product_add')
                ->whereBetween('date_add', [$startLastMonth, $endLastMonth])
                ->selectRaw(
                    'date(date_add) as date_add,
                    sum(quanity_add) as quanity,
                    sum(price) as sum_price'
                )->groupBy('date_add')->orderBy('date_add')->get();

            $order = Order::where('state', 5)
                ->whereBetween('order_date', [$startLastMonth, $endLastMonth])
                ->selectRaw('date(order_date) as order_date,total_price')
                ->orderBy('order_date')->get();
        } elseif ($req->time == '365ngay') {
            $sum_total = Order::where('state', 5)
                ->whereBetween('order_date', [$sub365day, $now])
                ->sum('total_price'); //doanh thu bán

            $sum_order = Order::whereBetween('order_date', [$sub365day, $now])
            ->count('order_id');

            $cancel_order = Order::where('state', 6)
                ->whereBetween('order_date', [$sub365day, $now])
                ->count('order_id');

            $complete_order = Order::where('state', 5) 
                ->whereBetween('order_date', [$sub365day, $now])
                ->count('order_id');

            $sum_sale = Order_Detail::rightJoin('order', 'order.order_id', '=', 'order_detail.order_id')    //số luongj bán
                ->where('state', 5)->whereBetween('order_date', [$sub365day, $now])
                ->sum('quanity_order');

            $product_add = Product_Add::whereBetween('date_add', [$sub365day, $now])
            ->sum('quanity_add');

            $pro = Product_Add::whereBetween('date_add', [$sub365day, $now])
                ->select('quanity_add', 'price', 'date_add')->get();
            $fee_add =  0;
            foreach ($pro as $p) {
                $fee_add += $p->quanity_add * $p->price;
            }

            $prod = DB::table('product_add')
                ->whereBetween('date_add', [$sub365day, $now])
                ->selectRaw(
                    'date(date_add) as date_add,
                    sum(quanity_add) as quanity,
                    sum(price) as sum_price'
                )->groupBy('date_add')->orderBy('date_add')->get();

            $order = Order::where('state', 5)
                ->whereBetween('order_date', [$sub365day, $now])
                ->selectRaw('date(order_date) as order_date,total_price')
                ->orderBy('order_date')->get();
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
        
        foreach ($order as $o) {
            $data[] =  $o->total_price;
            $date[] = $o->order_date;              
        }

        $date_add[] = null;
        $sum_quanity[] = null;
        $sum_price[] = null;

        if ($prod != null) {
            foreach ($prod as $p) {
                $date_add[] = $p->date_add;
                $sum_quanity[] = $p->quanity;
                $sum_price[] = $p->sum_price;
            }
        } else {
            $date_add[] = '';
            $sum_quanity[] = '';
            $sum_price[] = '';
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

    public function order_product(Request $req)
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $startOfMonth = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()
            ->toDateString();

        $sum_order = Order::whereBetween('order_date', [$startOfMonth, $now])->sum('order_id');

        $sum_prod = Order_Detail::rightJoin('order', 'order.order_id', '=', 'order_detail.order_id')
            ->whereBetween('order_date', [$startOfMonth, $now])    //số luongj bán
            ->where('state', 5)->sum('quanity_order');

        $num_prod = Order_Detail::rightJoin('order', 'order.order_id', '=', 'order_detail.order_id')
            ->whereBetween('order_date', [$startOfMonth, $now])
            ->distinct()->count('product_id');

        $order = DB::table('order')->
        join('order_state', 'order.state', '=', 'order_state.id')
            ->whereBetween('order_date', [$startOfMonth, $now])
            ->selectRaw(
                'count(order_id) as count,
                state_name,
                order_state.id'
            )->groupBy('state_name', 'order_state.id')->orderBy('order_state.id')->get();

        if ($req->fromDate != '' && $req->toDate != '') {

            $sum_order = Order::whereBetween('order_date', [$req->fromDate, $req->toDate])->sum('order_id');

            $sum_prod = Order_Detail::rightJoin('order', 'order.order_id', '=', 'order_detail.order_id')
                ->whereBetween('order_date', [$req->fromDate, $req->toDate])    //số luongj bán
                ->where('state', 5)->sum('quanity_order');

            $num_prod = Order_Detail::rightJoin('order', 'order.order_id', '=', 'order_detail.order_id')
                ->whereBetween('order_date', [$req->fromDate, $req->toDate])
                ->distinct()->count('product_id');

            $order = DB::table('order')->join('order_state', 'order.state', '=', 'order_state.id')
                ->whereBetween('order_date', [$req->fromDate, $req->toDate])
                ->selectRaw(
                    'count(order_id) as count,
                    state_name,
                    order_state.id'
                )->groupBy('state_name', 'order_state.id')->orderBy('order_state.id')->get();
        }
        
        $data_order = [
            'sum_order' => $sum_order,
            'sum_prod' => $sum_prod,
            'num_prod' => $num_prod 
        ];

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

    public function datatable(Request $req)
    {
        $pro = Product::join('order_detail', 'product.product_id', '=', 'order_detail'.'product_id')->
        selectRaw(
            'product.product_id,
            product_name,
            sum(quanoity_order * price),
            quanity'
        )->groupBy('product.product_id')->get();

        return Datatables::of($pro)->make(true);
    }
}
