<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Quên mật khẩu</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-pass-image">
                            </div>
                            <div class="col-lg-6 bg-pass">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-900 text-success mb-4">Đổi mật khẩu</h1>
                                    </div>
                                    <div class="alert alert-success" style="display:none">
                                    </div>                      
                                    <form id='resetForm' class="user" method='post'>
                                        <fieldset>
                                            <input type="hidden" name="token" id ='token' value="{{ $token }}">
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user"
                                                    name='newpass'
                                                    placeholder="Nhập mật khẩu mới " id="newpass" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user"
                                                    name='repass'
                                                    placeholder="Xác nhận lại mật khẩu " id="repass" required>
                                            </div>
                                            <div>
                                                <button style="text-align: center" class="btn btn-success btn-user btn-block btResetNew">Lưu thay đổi</button>
                                            </div>
                                        </fieldset>
                                    </form>
                                    <hr>
                                    <div class="text-center" >
                                        <a id ='login' style="color:white;" href="/forget-password"><--- Quay lại</a>
                                    </div>
                                    <div class="text-center" >
                                        <a id ='login'style="color:white;display:none" href="/login"><---Đăng nhập</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <script src="{{ asset('js/ajax/ajax_password.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>

</body>

</html>