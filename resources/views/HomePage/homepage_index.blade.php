@extends('HomePage.layout_homepage')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection

@section('content')
<br>
<div class="banner">
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
        <img src="{{asset('img/ao.jpg')}}" alt="">
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
    <!-- <div class="banner-side">
        <div class="banner-side mini">
            <img src="{{asset('img/men.jpg')}}" alt="">
        </div>
        <div class="banner-side mini">
            <img src="{{asset('img/men.jpg')}}" alt="">
        </div>
    </div> -->
<div>
<br><br>
<div class="container-xl">
	<div class="row">
		<div class="col-md-12 ">
            <div class="first-box">
                <h4 id="TitlePro">Tất cả sản phẩm</h4>
                <a href="#" id="all">Xem thêm >>></a>
            </div>
			<div  class="carousels slide">
                <div class="carousel-inner">
                    <div class="item">
                        <div class="row">
                            @for($i=0; $i<=4;$i++)
                            <div class="col-sm">
                                <div class="thumb-wrapper">
                                    <a href="/detail">
                                        <div class="img-box">
                                            <img src="{{asset('img/plus.jpg')}}" class="img-fluid" alt="">									
                                        </div>
                                    </a>
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

<br>
<br>

<div class="container-xl">
	<div class="row">
		<div class="col-md-12 ">
            <div class="first-box">
                <h4 id="TitlePro">Sản phẩm nổi bật</h4>
                <a href="#" id="all">Xem thêm >>></a>
            </div>
			<div  class="carousels slide">
                <div class="carousel-inner">
                    <div class="item">
                        <div class="row">
                            @for($i=0; $i<=4;$i++)
                            <div class="col-sm">
                                <div class="thumb-wrapper">
                                    <a href="/detail">
                                        <div class="img-box">
                                            <img src="{{asset('img/plus.jpg')}}" class="img-fluid" alt="">									
                                        </div>
                                    </a>
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

<br>
<br>
<div class="container-xl">
	<div class="row">
		<div class="col-md-12">
            <div class="first-box">
                <h4 id="TitlePro">Sản phẩm mới</h4>
                <a href="#" id="all">Xem thêm >>></a>
            </div>
			<div  class="carousels slide">
			<div class="carousel-inner">
				<div class="item">
					<div class="row">
                        @for($i=0; $i<=4;$i++)
						<div class="col-sm">
							<div class="thumb-wrapper">
                                <a href="/detail">
								<div class="img-box">
									<img src="{{asset('img/plus.jpg')}}" class="img-fluid" alt="">									
								</div>
                                </a>
                                <div class="new">
                                    <span class="text" style="color:white">New</span>
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

<br>
<br>
<div class="container">
	<div class="row">
		<div class="col-md-12">
            <div class="first-box">
                <h4 id="TitlePro">Sản phẩm Khuyến mãi</h4>
                <a href="#" id="all">Xem thêm >>></a>
            </div>
			<div  class="carousels slide">
                <div class="carousel-inner">
                    <div class="item">
                        <div class="row">
                            @for($i=0; $i<=4;$i++)
                            <div class="col-sm">
                                <div class="thumb-wrapper">
                                    <a href="/detail">
                                        <div class="img-box">
                                            <img src="{{asset('img/plus.jpg')}}" class="img-fluid" alt="">									
                                        </div>
                                    </a>
                                    <div class="discount">
                                        <span class="percent" style="color:red"> 30%</span>
                                        <span class="text" style="color:white">giảm</span>
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

<br>




@endsection

@section('script')
@endsection