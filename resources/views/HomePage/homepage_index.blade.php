@extends('HomePage.layout_homepage')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection

@section('content')
<br>
<div id="demo" class="carousel slide" data-ride="carousel" >

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
    <li data-target="#demo" data-slide-to="3"></li>
  </ul>

  <!-- The slideshow -->
  <div class="carousel-inner" >
    <div class="carousel-item active">
      <img src="{{asset('img/men.jpg')}}" alt="">
    </div>
    <div class="carousel-item">
      <img src="{{asset('img/menfashion.jpg')}}" alt="">
    </div>
    <div class="carousel-item">
      <img src="{{asset('img/quanao.jpg')}}" alt="">
    </div>
    <div class="carousel-item">
      <img src="{{asset('img/web-thoi-trang-nam.jpg')}}" alt="">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>

</div>
<br>

<div class="container">
    <!-- <div class="row">
        @for ($i=0; $i<=20; $i++)
        <div class="col-sm-3 ">
            <div class="single-item rectprod ">
                <div class="single-item-header">
                    <img src="{{asset('img/plus.jpg')}}" alt="Image">
                </div>
                <div id="text" class="single-item-body" style="text-align:center">
                    <p class="single-item-title">Tên sản phẩm</p>
                </div>
                <div  class="" style="text-align:center">
                    <a class="btn btn-primary btn-circle btn-sm" title="Chi tiết"><i class="fas fa-eye"></i></a>
                    <a class="btn btn-primary btn-circle btn-sm" title="Chi tiết"><i class="fas fa-shopping-cart"></i></a>
                </div>
            </div>
        </div>
        @endfor        
    </div> -->
</div>
<br>

<div class="col-sm-12">
    <div class="list-product">
        <h4>Sản phẩm mới</h4>
        <div class="row">
        @for ($i=0; $i<=3; $i++)
        <div class="col-sm-3 ">
            <div class="single-item rectprod ">
                <div class="single-item-header">
                    <img src="{{asset('img/plus.jpg')}}" alt="Image">
                </div>
                <div id="text" class="single-item-body" style="text-align:center">
                    <p class="single-item-title">Tên sản phẩm</p>
                </div>
                <!-- <div  class="" style="text-align:center">
                    <a class="btn btn-primary btn-circle btn-sm" title="Chi tiết"><i class="fas fa-eye"></i></a>
                    <a class="btn btn-primary btn-circle btn-sm" title="Chi tiết"><i class="fas fa-shopping-cart"></i></a>
                </div> -->
            </div>
        </div>
        @endfor      
        </div>
    </div>
</div>
<br>
<br>
<div class="col-sm-12">
    <div class="list-product">
        <h4>Sản phẩm bán chạy</h4>
        <div class="row">
        @for ($i=0; $i<=3; $i++)
        <div class="col-sm-3 ">
            <div class="single-item rectprod ">
                <div class="single-item-header">
                    <img src="{{asset('img/plus.jpg')}}" alt="Image">
                </div>
                <div id="text" class="single-item-body" style="text-align:center">
                    <p class="single-item-title">Tên sản phẩm</p>
                </div>
                <!-- <div  class="" style="text-align:center">
                    <a class="btn btn-primary btn-circle btn-sm" title="Chi tiết"><i class="fas fa-eye"></i></a>
                    <a class="btn btn-primary btn-circle btn-sm" title="Chi tiết"><i class="fas fa-shopping-cart"></i></a>
                </div> -->
            </div>
        </div>
        @endfor      
        </div>
    </div>
</div>

<br>
<br>
<div class="col-sm-12">
    <div class="list-product">
        <h4>Sản phẩm khuyến mãi</h4>
        <div class="row">
        @for ($i=0; $i<=3; $i++)
        <div class="col-sm-3 ">
            <div class="single-item rectprod ">
                <div class="single-item-header">
                    <img src="{{asset('img/plus.jpg')}}" alt="Image">
                </div>
                <div id="text" class="single-item-body" style="text-align:center">
                    <p class="single-item-title">Tên sản phẩm</p>
                </div>
                <!-- <div  class="" style="text-align:center">
                    <a class="btn btn-primary btn-circle btn-sm" title="Chi tiết"><i class="fas fa-eye"></i></a>
                    <a class="btn btn-primary btn-circle btn-sm" title="Chi tiết"><i class="fas fa-shopping-cart"></i></a>
                </div> -->
            </div>
        </div>
        @endfor      
        </div>
    </div>
</div>



@endsection

@section('script')
@endsection