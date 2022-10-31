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
    public function listProduct(Request $req)
    {
        // $product=DB::table('product')
        //     ->join('supplier', 'product.supplier_id', '=', 'supplier.id')
        //     ->select('product_id', 'product_name', 'unit_price', 'image', 'is_sale', 'supplier.supplier_name')
        //     ->get();
        $p = DB::table('product')
            ->join('supplier', 'product.supplier_id', '=', 'supplier.id')
            ->select(
                'product_id', 
                'product_name',
                'unit_price',
                'image',
                'is_sale',
                'supplier.supplier_name'
            );

        
        if (!empty($req->pricefrom) && !empty($req->pricefrom)) {
            $p = $p->whereBetween('unit_price', [$req->pricefrom, $req->priceto]);
        }

        if (!empty($req->state)) {
            $p = $p->where('is_sale', $req->state);
        }

        if (!empty($req->key)) {
            $p = $p->where('product_name', 'like', '%'. $req->key .'%')
                ->orWhere('product_name', 'like', '%'. $req->key .'%');
        }
        $p->get();

        return Datatables::of($p)
            ->addColumn(
                'product_name', function ($p) {
                    return '<a value=" '. $p->product_id .'" class="btDetail">' . $p->product_name .'</a>';
                }
            )
            ->addColumn(
                'image', function ($p) {
                    $url = asset('img/' . $p->image);
                    return '<img src="'. $url .'" alt="Picture" style="width:50px;height:50px">';
                }
            )
            ->addColumn(
                'is_sale', function ($p) {
                    $temp = $p->is_sale == 0 ? '<td><span style="color:red">Ngừng bán</span></td>'
                                    : '<td><span style="color:green">Đang bán</span></td>';
                    return $temp;
                }
            )
            ->addColumn(
                'action', function ($p ) {
                    return '<a value="'. $p->product_id. '" class="btn btn-success btn-circle btn-sm bt-Update">
                        <i class="fas fa-pen"></i>
                    </a>
                    <a value=" '. $p->product_id .'" class="btn btn-danger btn-circle btn-sm bt-Delete" >
                        <i class="fas fa-trash"></i>
                    </a>
                    <a value=" '. $p->product_id .'" class="btn btn-warning btn-circle btn-sm bt-Block">
                        <i class="fas fa-lock"></i>
                    </a>';
                }
            )
            ->rawColumns(['product_name','image','is_sale','action'])
            ->make(true);
    }

    public function addProduct()
    {
        return view('Admin.Product.add_product');
    }

    public function getIdProduct($id)
    {
        $pro=Product::where('product_id',$id)->get();
        return response()->json(
            [ 
                'state'=>200,
                'pro'=>$pro
            ]
        );
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
