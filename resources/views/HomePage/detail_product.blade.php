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
                <a href="">Home</a> / <span>Chi tiết sản phẩm</span>/<span>Tên sản phẩm</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="product">
    <div class="contain">
        <div class="left">
            <img src="{{asset('img/plus.jpg')}}"  alt="picture" /> 
            <div class="minileft">
                <div><img src="{{asset('img/web-thoi-trang-nam.jpg')}}" alt="picture" onClick="doianh(this)" /></div>
                <div><img src="{{asset('img/web-thoi-trang-nam.jpg')}}" alt="picture" onClick="doianh(this)" /></div>
                <div><img src="{{asset('img/web-thoi-trang-nam.jpg')}}" alt="picture" onClick="doianh(this)" /></div>
                <div><img src="{{asset('img/web-thoi-trang-nam.jpg')}}" alt="picture" onClick="doianh(this)" /></div>
                <div><img src="{{asset('img/web-thoi-trang-nam.jpg')}}" alt="picture" onClick="doianh(this)" /></div>
            </div>           
        </div>
        <div class="right">
            <h2>Tên sản phẩm</h2>
            <h2 class="red">Giá sản phẩm VNĐ</h2>
            <h6>Số lượng:</h6>
            <div>
            <button onClick="" class="btn btn-outline-success" >
                <a id="add-cart" href=""><i class="fas fa-shopping-cart"></i>
                Thêm vào giỏ hàng
                </a>
            </button>  
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">Mô tả</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu1">Đánh giá</a>
    </li> 
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="container tab-pane active"><br>
      <h5>Mô tả chi tiết</h5>
      <p></p>
    </div>
    <div id="menu1" class="container tab-pane fade"><br>
        <div class="media border p-3">
            <img src="img_avatar3.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
            <div class="media-body">
                <h5>John Doe <small><i>Posted on February 19, 2016</i></small></h5>
                <p>Lorem ipsum...</p>
                <div class="media p-3">
                <img src="img_avatar2.png" alt="Jane Doe" class="mr-3 mt-3 rounded-circle" style="width:45px;">
                <div class="media-body">
                    <h5>Jane Doe <small><i>Posted on February 20 2016</i></small></h5>
                    <p>Lorem ipsum...</p>
                </div>
                </div> 
            </div>
        </div>
    </div>
  </div>
</div>

<br><br>
<div class="container-xl">
	<div class="row">
		<div class="col-md-12 ">
            <div class="first-box">
                <h4 id="TitlePro">Sản phẩm tương tự</h4>
                <a href="#" id="all">Xem thêm >>></a>
            </div>
			<div  class="carousels slide">
                <div class="carousel-inner">
                    <div class="item">
                        <div class="row">
                            @for($i=0; $i<=4;$i++)
                            <div class="col-sm">
                                <div class="thumb-wrapper">
                                    <span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                    <div class="img-box">
                                        <img src="{{asset('img/plus.jpg')}}" class="img-fluid" alt="">
                                    </div>
                                    <div class="thumb-content">
                                        <h4>Apple iPad</h4>
                                        <p class="item-price"><strike>$400.00</strike> <b>$369.00</b></p>
                                        <a href="#" class="btn btn-primary">Add to Cart</a>
                                    </div>	
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
		    </div>
		</div>
	</div>
</div>
@endsection

@section('script')
@endsection