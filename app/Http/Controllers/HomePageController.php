<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_Img;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Order_Detail;
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

    /**
     * Thêm sản phẩm vào giỏ.
     *
     * @param string $req The URL api 
     * @param int    $id  The URL api
     * 
     * @return string  json Trả dữ liệu json
     * 
     * @author Mr dang.trong<dang.trong@rivercrane.com.vn>
     */
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
            return view('HomePage.cart-detail');
            // return response()->json(
            //     [
            //         'message' => 'Thêm thành công vào giỏ'
            //     ]
            // );
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Cập nhật sô lượng sản phẩm trong giỏ.
     *
     * @param string $req The URL api
     * @param int    $id  The URL api
     * 
     * @return string  json Trả dữ liệu json
     * 
     * @author Mr dang.trong<dang.trong@rivercrane.com.vn>
     */
    public function updateOfCart(Request $req, $id)
    {
        try {
            $oldcart = Session::has('Cart') ? Session::get('Cart') : null;
            $newcart = new Cart($oldcart);
            $newQua = $req->newQuanity;
            $newcart->UpdateItemCart($id, $newQua);
            Session::put('Cart', $newcart);
            return response()->json(
                [
                    'message' => 'Cập nhật thành công'
                ]
            );
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Xóa sản phẩm trong giỏ.
     *
     * @param int $id The URL api
     * 
     * @return string  json Trả dữ liệu json
     * 
     * @author Mr dang.trong<dang.trong@rivercrane.com.vn>
     */
    public function delOfPro($id)
    {
        try {
            $oldcart = Session::has('Cart') ? Session::get('Cart') : null;
            $newcart = new Cart($oldcart);
            $newcart->DelItemCart($id);
            if (count($newcart->products) > 0) {
                Session::put('Cart', $newcart);
            } else {
                Session::forget('Cart', $newcart);
            }
            // return redirect('/detail-cart');
            return response()->json(
                [
                    'message' => 'Xóa sản phẩm thành công'
                ]
            );
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * Trang kiểm tra trước đặt hàng.
     * 
     * @author Mr dang.trong<dang.trong@rivercrane.com.vn>
     */
    public function checkOut()
    {
        return view('HomePage.check_out');
    }
    /**
     * Đặt hàng.
     *
     * @param string $req 
     * 
     * @return string  json Trả dữ liệu json
     * 
     * @author Mr dang.trong<dang.trong@rivercrane.com.vn>
     */
    public function sendOrder(Request $req)
    {
        $cart = Session::get('Cart');
        
        $cus = Customer::create(
            [
                "customer_name" => $req->name,
                "email" => $req->email,
                "phone" => $req->phone,
                "address" => $req->address,
            ]
        );

        $cuss = $cus->where('customer_id', $cus->customer_id)->first();

        $bill = Order::create(
            [
                "customer_id" => $cuss->customer_id,
                "order_date" => date('Y-m-d H:i:s'),
                "total_price" => $cart->totalPrice,
                "type_payment"=>$req->payment,
                "description" => $req->note,
                "state" => 1
            ]
        );
        $bill->save();

        foreach ($cart->products as $p) {
            $detail = Order_Detail::create(
                [
                    "order_id" => $bill->order_id,
                    "product_id" => $p['prodInfo']->product_id,
                    "quanity_order" => $p['quanity'],
                    "price" => $p['prodInfo']->unit_price
                ]
            );
            $detail->save();
        }
        Session::forget('Cart');

        return response()->json(
            [
                'url' => '/checkOut',
                'message' => ' Đặt hàng thành công'
            ]
        );
    }

    /**
     * Tìm kiếm sản phẩm
     *
     * @param string $req 
     * 
     * @return string  view
     * 
     * @author Mr dang.trong<dang.trong@rivercrane.com.vn>
     */
    public function search(Request $req)
    {
        $product = Product::where('product_name', 'like', '%'. $req->search .'%')->get();
        return view('HomePage.product_list', compact('product'));
    }
    /**
     * Tìm kiếm sản phẩm theo danh mục
     *
     * @param int $id 
     * 
     * @return string  view
     * 
     * @author Mr dang.trong<dang.trong@rivercrane.com.vn>
     */
    public function getOfCate($id)
    {
        $product = Product::where('category_id', $id)->get();
        return view('HomePage.product_list', compact('product'));
    }
}
