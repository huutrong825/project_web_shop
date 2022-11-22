@extends('HomePage.layout_homepage')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection

@section('content')
<br>
<div class="inner-header">
    <div class="container">
        <div class="">
            <div class="beta-breadcrumb font-large">
                <a href="">Trang chủ</a> / <span>Giỏ hàng</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<br><br>
<div class="detailcart"> 
<div class="col-sm-12">
    <div class="table-responsive">
        <table class="table table-bordered">
            @if(Session::has("Cart")!=null)
            <tr>
                <th colspan='2'>Sản phẩm</th>  
                <th>Số lượng</th>
                <th>Đơn vị tính</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
                <th>Thao tác</th>
            </tr>            
            @foreach(Session::get("Cart")->products as $p)               
                <tr>
                    <td>
                        <img src=""  width='100' heigth='150'/>
                    </td>
                    <td><a href="">{{$p['prodInfo']->ProductName}}</a></td>
                    <td>
                        <form action="" method='post'>
                            @csrf
                            <input type="number" name="txtSoluong" font-size=''value="{{$p['quanity']}}" />
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                    </td>
                    <td></td>                    
                    <td><?php echo number_format($p['prodInfo']->Price);?> VNĐ</td>
                    <td><?php echo number_format($p['price']);?> VNĐ</td>
                    <td>
                        <a href="{{route('DelItemCart',['ProductID'=>$p['prodInfo']->ProductID])}}" class="btn btn-danger" onclick="return">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2"> Tổng số lượng</td>
                <td>{{Session::get("Cart")->totalQuanity}}</td>
                <td colspan="2">Tổng thành tiền</td>
                <td><?php echo number_format(Session::get("Cart")->totalPrice);?> VNĐ</td>
                <td></td>
            </tr>
            <tr>
                <td colspan='5'></td>
                <td colspan='2'>
                    <a href="{{route('CheckOrder')}}" class="btn btn-warning" >Xác nhận đặt hàng</a>
                </td>
            </tr>
            @else
                <p>Không có sản phẩm nào trong giỏ </p>
                <div>
                <a class="btn btn-outline-success" href="/" style="text-decoration:none">
                    <i class="fas fa-shopping-cart"></i>
                    <span>MUA NGAY</span>
                </a>  
                </div> 
            @endif
        </table>
    </div>
</div>
</div>


@endsection

@section('script')
@endsection