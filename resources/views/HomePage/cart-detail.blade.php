
@if(Session::has("Cart")!=null)
<div class="cart-body">
    <div class="cart-item">
        @foreach(Session::get("Cart")->products as $p)
        <div class="media">
            <a class="pull-left" href="#"><img src="{{asset('img')}}/{{$p['prodInfo']->image}}" width="50" height="50" alt=""/></a>
            <div class="media-body">
            <span class="cart-item-title">{{$p['prodInfo']->product_name}}</span>
            <span class="cart-item-amount"> <span><?php echo number_format($p['prodInfo']->unit_price, 0, '.', ' ');?> VNĐ</span></span>
            </div>
        </div>
        <br>
        @endforeach
    </div>
    <div class="cart-caption">
        <div class="cart-total text-right">Tổng tiền: <span class="cart-total-value"><?php echo number_format(Session::get("Cart")->totalPrice, 0, '.', ' ');?> VNĐ</span></div>
        <div class="clearfix"></div>
        <div class="center">
            <div class="space10">&nbsp;</div>
            <a href="checkout.html" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
        </div>
    </div>
</div>
@else
<div class="cart-body cart-null" >
<span>Chưa có sản phẩm trong giỏ</span>
</div>
@endif