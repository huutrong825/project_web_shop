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
            <div id='avatar'class=" text-center">
                <img src="{{asset('img')}}/{{Auth::User()->avatar}}" class="avatar img-circle img-thumbnail" style='width:240px;height:320px'alt="avatar">
                <h6>Upload a different photo...</h6>
                <input type="file" name="avatar" id="avatar" class="text-center center-block file-upload">
                <!-- <div id="show"></div> -->
            </div>
            <br>
            <div class="">
                <div class="col-xs-6">
                    <label for="name">Tên người dùng</label>
                    <input type="text" class="form-control" name="name"  value="{{ $u->name }}"  >
                </div>
                <div class="col-xs-6">
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
                    <label for="birth">Ngày sinh</label>
                    <input type="text" class="form-control "
                        name="birth" placeholder = " {{ $u->birth }}" value=" {{ $u->birth }}" onfocus="(this.type='date')" onblur="(this.type='text')" >
                    <!-- <input type="date" class="form-control" name="date" value=" {{ $u->birth }}"> -->
                </div>
                <div class="col-xs-6">
                    <label for="">Địa chỉ</label>
                    <input type="text" class="form-control" name="address" value="{{ $u->address }}">
                </div>
                <div class="col-xs-12">
                    <br>
                    <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                    <button class="btn btn-lg btn-danger" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                </div>
            </div>
        </form>
        <a href="#" id="changepass">Đổi mật khẩu</a>
    @endforeach
</div>

<!-- Modal Password -->
<div class="modal fade" id="NewPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Đổi mật khẩu</h5>
            </div>
            <div class="modal-body">
            <form  class="user" id='formpassword' method='post'>
                @csrf
                <fieldset>
                    <div class="" >
                        <div class="form-group">
                            <input type="hidden" type="text" class="form-control form-control-user" name="mail" value="{{ $u-> email }}">
                        </div>  
                    </div>                                                
                    <div class="">
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" id="password" name="password"
                                placeholder="Nhập mật khẩu cũ" required>
                        </div>
                        <p style="color:red" class="help is-danger"></p>
                    </div>
                    <div class="">
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" id="newpass" name="newpass"
                                placeholder="Nhập mật khẩu mới" required>
                        </div>
                    </div>
                    <div class="">
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" id="repass" name="repass"
                                placeholder="Nhập lại mật khẩu mới" required>
                        </div>
                    </div>
                </fieldset>
            </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btsave" type="button" >Lưu</button> 
                <button class="btn btn-danger " type="button" data-dismiss="modal">Cancel</button>                    
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script src="{{asset('js\crop_image\cropzee.js')}}"></script>

<script src="{{asset('js\ajax\upload_avatar.js')}}"></script>
<script src="{{asset('js\ajax\ajax_password.js')}}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
@endsection