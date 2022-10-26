<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        return view('Admin.Product.list_product');
    }
    public function listProduct()
    {
        $p=DB::table('product')->join('supplier', 'product.supplier_id', '=', 'supplier.id')
                               ->select('product_id', 'product_name', 'unit_price', 'image', 'is_sale', 'supplier.supplier_name')
                               ->get();

        return Datatables::of($p)
               ->addColumn('image', function ($p){
                   return '<img url="{{'. $p->image .'}}" alt="Picture" style="width:50px;height:50px">';
               })
               ->addColumn('is_sale', function ($p){
                   $temp=$p->is_sale==0?'<td><span style="color:red">Ngừng bán</span></td>'
                                        :'<td><span style="color:green">Đang bán</span></td>';
                    return $temp;
               })
               ->addColumn('action', function ($p ) {
                    return '<a value="'. $p->product_id. '" class="btn btn-success btn-circle btn-sm bt-Update">
                        <i class="fas fa-pen"></i>
                    </a>
                    <a value=" '. $p->product_id .'" class="btn btn-danger btn-circle btn-sm bt-Delete" >
                        <i class="fas fa-trash"></i>
                    </a>
                    <a value=" '. $p->product_id .'" class="btn btn-warning btn-circle btn-sm bt-Block">
                        <i class="fas fa-lock"></i>
                    </a>';
                })
               ->rawColumns(['image','is_sale','action'])
               ->make(true);
    }

    public function addProduct()
    {
        return view('Admin.Product.add_product');
    }

    public function getfixProdudct()
    {

    }

    public function postFixProduct()
    {

    }

    public function deleteProduct()
    {

    }

    public function getDetailProduct()
    {

    }

    public function postDetailProduct()
    {

    }
}
