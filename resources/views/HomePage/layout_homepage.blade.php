<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" >
    <title>Trang chủ</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <script href="{{asset('css/detail-product.css')}}" rel="stylesheet"></script>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Open+Sans">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    @yield('css')

</head>

<body id="page-top">

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>WebShop - Trang bán hàng</title>
        <link href="{{asset('images/construction.png')}}" rel="shortcut icon" />
        <link href="{{asset('css/homepage.css')}}" rel="stylesheet" >
        <script defer src="{{asset('js/buttonOnTop.js')}}" rel="stylesheet"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- jQuery library -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    </head>
    <body>
        <div>
            <div>
                <div>

                </div>
            </div>
            <div class="head">
                <div >
                    <h2 style="padding-top:30px; float:left; color:#53a6d8"> WEB SHOP</h2>
                </div>  
                <div class="search" >
                    <form method="get" action=""> 
                        <div class="input-group mb-3">
                            <!-- <input id="myFind" name="search" type="text" class="form-control inputSeacrh" placeholder="Nhập sản phẩm cần tìm"> -->
                            
                        </div>                    
                    </form>
                </div>
                <div>
                    <button class="btn btn-success" ><i class="fas fa-search"></i></button>
                </div>
                <div class="cart">
                  <a href="/detail-cart">
                    <button class="btn btn-danger"> <i class="fas fa-shopping-cart"></i> Giỏ Hàng
                    @if(Session::has("Cart")!=null)
                    <span class="badge">{{Session::get('Cart')->totalQuanity}}</span>
                    @endif
                    </button>
                  </a>
                  @if(Session::has("Cart")!=null)
                  <div class="cart-body">
                    <div class="cart-item">
                    @foreach(Session::get("Cart")->products as $p)
                      <div class="media">
                        <a class="pull-left" href="#"><img src="" width="50" height="50" alt="Product"/></a>
                        <div class="media-body">
                          <span class="cart-item-title"></span>
                          <span class="cart-item-amount">{{$p['quanity']}}*<span> VNĐ</span></span>
                        </div>
                      </div>
                    @endforeach
                    </div>
                    <div class="cart-caption">
                      <div class="cart-total text-right">Tổng tiền: <span class="cart-total-value"> VNĐ</span></div>
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
                  </div>
                </div>
            </div>            
            <div class="main">
                <nav class="navbar navbar-expand-sm bg-light">
                    <!-- Links -->
                    <ul class="navbar-nav">
                        <li class="nav-item col-sm-3">
                            <a class="nav-link" href="/">Trang chủ</a>
                        </li>
                        <li class="nav-item col-sm-3">
                            <a class="nav-link" href="#">Danh mục 1</a>
                        </li>
                        <li class="nav-item col-sm-3">
                            <a class="nav-link" href="#">Danh mục 2</a>
                        </li>
                        <li class="nav-item col-sm-3">
                            <a class="nav-link" href="#">Danh mục 3</a>
                        </li>
                        <li class="nav-item col-sm-3">
                            <a class="nav-link" href="#">Danh mục 4</a>
                        </li>
                        <li class="nav-item col-sm-3">
                            <a class="nav-link" href="#">Khuyến mãi</a>
                        </li>
                    </ul>
                </nav>
            </div>
            
            <div class="bodymain">
              @yield('content')
            </div> 

            <div class="footer">
                <div id="footer" class="color-div">
                <div class="container">
                    <div class="row">
                    <div class="col-sm-3">
                        <div class="widget">
                        <h4 class="widget-title"></h4>
                        <div id="beta-instagram-feed">
                            <div></div>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="widget">
                        <h4 class="widget-title">Thông tin</h4>
                        <div>
                            <ul>
                            <li>
                                <a href="/">
                                <i class="fa fa-chevron-right"></i> Trang chủ </a>
                            </li>
                            <li>
                                <a href="">
                                <i class="fa fa-chevron-right"></i> Dịch vụ </a>
                            </li>
                            <li>
                                <a href="">
                                <i class="fa fa-chevron-right"></i> Tin tức </a>
                            </li>
                            <li>
                            <a href="">
                            <i class="fa fa-chevron-right"></i> Liên hệ </a>
                            </li>
                            </ul>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="col-sm-10">
                        <div class="widget">
                            <h4 class="widget-title">Thông tin liên hệ</h4>
                            <div>
                            <div class="contact-info">
                                <i class="fa fa-map-marker"></i>
                                <p>371 Nguyen Kiem P3 Go Vap Tp Ho Chi Minh</p>
                                <p>Phone: +78 123 456 78</p>
                                <p></p>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- <div class="col-sm-3">
                        <div class="widget">
                        <h4 class="widget-title">Newsletter Subscribe</h4>
                        <form action="#" >
                            <input type="email" name="your_email">
                            <button class="pull-right" type="submit">Subscribe <i class="fa fa-chevron-right"></i>
                            </button>
                        </form>
                        </div>
                    </div> -->
                    </div>
                </div>                
                </div>
                <div class="copyright">
                <div style="text-align:center" class="container">
                    <p class="pull-left">Copyright &copy;  Web vật liệu xây dựng | Thiết kế bởi Trong Huu</p>
                    <p class="pull-right pay-options">
                    <a href="#">
                        <img src="{{asset('image-page/mastercard.png')}}" alt="" width="48" height="48"/>
                    </a>
                    <a href="#">
                        <img src="{{asset('image-page/pay.png')}}" alt="" width="48" height="48"/>
                    </a>
                    <a href="#">
                        <img src="{{asset('image-page/visa.png')}}" alt=""width="48" height="48" />
                    </a>
                    <a href="#">
                    <img src="{{asset('image-page/paypal.png')}}" alt=""width="48" height="48" />
                    </a>
                    </p>
                </div>
            <!-- .container -->
            </div>
        </div>            
      
        <div>
            <a onClick="topFunction()" id="onTop" title='Go to top' class='btn btn-primary' >
                <i class="fas fa-angle-double-up"></i>
            </a>
        </div>         

        <div class="icon-bar">
            <a target="_blank"  href="https://www.facebook.com" >
                    <img src="{{asset('image-page/facebook.png')}}" alt="Facebook" title="Facebook" width="48" height="48">
            </a>
        
            <a target="_blank"  href="https://zalo.me/" >
                    <img src="{{asset('image-page/zalo.png')}}" width="48" height="48" alt="Zalo" title="Zalo">
            </a>
            
            <a target="_blank"  href="https://www.instagram.com/" >
            <img src="{{asset('image-page/Instagram.png')}}" width="48" height="48" alt="youtube" title="Instagram">
            </a>          
        </div>
   

    </body>

</html>