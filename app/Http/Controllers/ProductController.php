<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_Img;
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

        
        if ($req->pricefrom != '') {
            $p = $p->where('unit_price', '>=', $req->pricefrom);
        }

        if ($req->priceto != '') {
            $p = $p->where('unit_price', '<=', $req->priceto);
        }

        if (!empty($req->state)) {
            $p = $p->where('is_sale', $req->state);
        }

        if (!empty($req->key)) {
            $p = $p->where('product_name', 'like', '%'. $req->key .'%')
                ->orWhere('email', 'like', '%'. $req->key .'%');
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
                    return '<a href="/admin/product/dropImage/'. $p->product_id .'" class="btn btn-primary btn-circle btn-sm btDropImg" >
                        <i class="fas fa-images"></i>
                    </a>
                    <a value=" '. $p->product_id .'" class="btn btn-danger btn-circle btn-sm btDelete" >
                        <i class="fas fa-trash"></i></a>
                    <a value=" '. $p->product_id .'" class="btn btn-warning btn-circle btn-sm btBlock">
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
        $pro = Product::join('supplier', 'product.supplier_id', '=', 'supplier.id')
            ->where('product_id', $id)->get();
        return response()->json(
            [ 
                'state'=>200,
                'pro'=>$pro,
            ]
        );
    }

    public function blockProduct($id)
    {
        $pro = Product::where('product_id', $id)->first();
        
        if ($pro->is_sale == 1) {
            $pro->update(
                [
                    'is_sale' => 0
                ]
            );
        } else {
            $pro->update(
                [
                    'is_sale' => 1
                ]
            );
        }
        return response()->json(
            [ 
                'state' => 200,
                'messages' =>  'Cập nhật thành công'
            ]
        );
    }

    public function deleteProduct($id)
    {
        $pro = Product::where('product_id', $id)->first();
        
        $pro->delete();
        return response()->json(
            [ 
                'state'=>200,
                'messages'=> 'Xóa thành công'
            ]
        );
    }

    public function updatePro(Request $req, $id)
    {
        $pro = Product::where('product_id', $id)->first();
        $pro->update(
            [
                'product_name' => $req->nameUp,
                'unit_price' => $req->priceUp,
                'description' => $req->descrip,
                'supplier_id' => $req->supp,
            ]
        );
        return response()->json(
            [ 
                'state'=>200,
                'messages'=> 'Cập nhật thành công'
            ]
        );
    }
    
    public function uploadImg(Request $req, $id)
    {
        if ($req->imgUp) {
            $img_name = $req->imgUp->getClientOriginalName();
            $req->imgUp->move(public_path('img'), $img_name);
        }
        $pro = Product::where('product_id', $id)->first();
        $pro->update(
            [
                'image' => $img_name,
            ]
        );
        return response()->json(
            [ 
                'state'=>200,
                'image'=> $img_name
            ]
        );
    }
    public function dropIndex($id)
    {
        $pro = Product::where('product_id', $id)->first();
        return view('Admin.Product.drop_image', compact('pro'));
    }

    public function imageDrop(Request $req, $id)
    {
        if ($req->ajax()) {
            if ($req->file) {
                $img_name = $req->file->getClientOriginalName();
                $req->file->move(public_path('img'), $img_name);
            }
        }
        Product_Img::create(
            [
                'product_id' => $id,
                'img_url' => $img_name
            ]
        );
    }

    public function getImage($id)
    {
        $img = Product_Img::where('product_id', $id)->get();
     
        $output = '<div class="row">';
        foreach ($img as $i) {
            $output .= '
            <div class="col-md-2">
                <img src="http://127.0.0.1:8000/img/'. $i->img_url .'" class="img-thumbnail" width="175" height="175" style="height:175px;" />
                <button type="button" class="btn btn-link remove_image" value="'. $i->id .'">Remove</button>
            </div>';
        }
        $output .= '</div>';

        return response()->json(
            [
                'img' => $output
            ]
        );
    }

    public function removeImage($id)
    {
        $img = Product_Img::where('id', $id)->first();
        $img->delete();
        return response()->json(
            [
                'message' => 'Suucess'
            ]
        );
    }
}
