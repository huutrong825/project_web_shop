@extends('layout_admin')
@section('content')
@if(session('thongbao'))
    <div class="alert alert-success">
        {{session('thongbao')}}
    </div>
@endif
<div class="frofile"> 
    @foreach($user as $u)
        <form class="form" action="/admin/profile" method="post" enctype="multipart/form-data">
            @csrf
            <div id='avatar'class="left text-center">
                <img src="{{asset('img')}}/{{Auth::User()->avatar}}" class="avatar img-circle img-thumbnail" style='width:240px;height:320px'alt="avatar">
                <h6>Upload a different photo...</h6>
                <input type="file" name="avatar" class="text-center center-block file-upload">
            </div>
            <br>
            <div class="right">
                <div>
                    <label for="name">Tên người dùng</label>
                    <input type="text" class="form-control" name="name"  value="{{ $u->name }}"  >
                </div>
                <div>
                <label for="email">Email</label>
                    <input type="text" class="form-control" name="mail" value="{{ $u-> email }}" disabled>
                </div>
                <div class="col-xs-6">
                    <label for="phone">Giới tính:   </label> <span>{{ $u-> sex }} </span><br>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" value="Nam" name="sex">Nam
                        </label>
                        </div>
                        <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" value="Nữ" name="sex">Nữ
                        </label>
                    </div>
                </div><br>
                <div class="col-xs-6">
                    <label for="mobile">Số điện thoại</label>
                    <input type="text" class="form-control" name="phone" value="{{ $u->phone }}" >
                </div>
                <div class="col-xs-6">
                    <label for="date">Ngày sinh</label>
                    <input type="date" class="form-control" name="date" value=" {{ $u->birth }}">
                </div>
                <div class="col-xs-6">
                    <label for="">Địa chỉ</label>
                    <input type="text" class="form-control" name="address" value="{{ $u->address }}">
                </div>
                <div class=" form-group custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="Check" name="checkPass">
                    <label class="custom-control-label" for="Check">Thay đổi mật khẩu</label>
                </div>
                <div class="col-xs-6" id="pass1"  style="display:none">
                    <label for="password">Password</label>
                    <input type="password" class="form-control"  name="password"  placeholder="password" title="enter your password.">
                </div>
                <div class="col-xs-6" id="pass2"  style="display:none">
                <label for="password2">Repassword</label>
                    <input type="password" class="form-control"  name="repass"  placeholder="password2" title="enter your password2.">
                </div>
                <div class="col-xs-12">
                    <br>
                    <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                    <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                </div>
            </div>
        </form>
    @endforeach
    <hr>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function (){
        $("#Check").click(function(){
            $("#pass1").toggle();
            $("#pass2").toggle();
        });
    });
</script>
@endsection