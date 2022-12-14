@extends('HomePage.layout_homepage')

@section('title')
   Giỏ hàng
@endsection

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="/">Trang chủ</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    @if (Session::has("Cart") != null)
                    <thead class="thead-dark">
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach(Session::get("Cart")->products as $p)
                        <tr>
                            <td class="align-middle"><img src="{{ asset('img') }}/{{ $p['prodInfo']->image }}" alt="" style="width: 50px; height:50px"> {{ $p['prodInfo']->product_name }}</td>
                            <td class="align-middle"><?php echo number_format($p['prodInfo']->unit_price, 0, '.', ' ');?> đ</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" >
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <!-- <form method='post'>
                                        @csrf -->
                                    <input type="text" id='changeQua' class="form-control form-control-sm bg-secondary border-0 text-center" value="{{ $p['quanity'] }}">
                                    <!-- </form> -->
                                    <div class="input-group-btn">
                                        <button  class="btn btn-sm btn-primary btn-plus ">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle"><?php echo number_format($p['price'], 0, '.', ' ');?> đ</td>
                            <td class="align-middle">
                                <a class="btn btn-sm btn-danger btDelPro" value ="{{ $p['prodInfo']->product_id }} "><i class="fa fa-times"></i></a>
                                <a class="btn btn-sm btn-success btUpQua" value ="{{ $p['prodInfo']->product_id }} "><i class="fa fa-save"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <p>Không có sản phẩm nào trong giỏ </p>
                        <div>
                        <a class="btn btn-outline-success" href="/" style="text-decoration:none">
                            <i class="fas fa-shopping-cart"></i>
                            <span>MUA NGAY</span>
                        </a>  
                        </div>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <!-- <form class="mb-30" action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form> -->
                @if (Session::has("Cart") != null)
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Tổng tiền hàng</h6>
                            <h6><?php echo number_format(Session::get("Cart")->totalPrice, 0, '.', ' ');?> VNĐ</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Phí vận chuyển</h6>
                            <h6 class="font-weight-medium">$10</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Tổng thanh toán</h5>
                            <h5><?php echo number_format(Session::get("Cart")->totalPrice, 0, '.', ' ');?> VNĐ</h5>
                        </div>
                        <a href="/checkOut" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Đặt hàng</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('script')
@endsection