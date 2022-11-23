<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_Img;
use Carbon\Carbon;
use Exception;
use App\Models\Cart;
use Session;

class HomePageController extends Controller
{
    public function home_index()
    {
        try {
            $product = Product::all();
            $pro_disc = Product::where('discount', '!=', 0);
            return view('HomePage.homepage_index', compact('product'));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function detailProduct($id)
    {
        $product = Product::where('product_id', $id)->first();
        $prod_img = Product_Img::where('product_id', $id)->get();
        $prod_same = Product::where('product_name', 'like', '%'. $product->product_name .'%')->get();
        return view('HomePage.detail_product', compact('product', 'prod_img', 'prod_same'));
    }

    public function cart()
    {
        return view('HomePage.Cart');
    }
    public function addToCart(Request $req, $id)
    {
        try {
            $product = Product::where('product_id', $id)->first();
            if ($product != null) {
                $oldcart = Session('Cart') ? Session('Cart') : null;
                $newcart = new Cart($oldcart);
                $newcart->AddCart($product, $id);
                $req->session()->put('Cart', $newcart);
            }
            return response()->json(
                [
                    'message' => 'Thêm thành công vào giỏ'
                ]
            );
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function checkOut()
    {
        return view('HomePage.check_out');
    }
}
