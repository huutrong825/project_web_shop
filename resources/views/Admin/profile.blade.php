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
                    <label for="date">Ngày sinh</label>
                    <input type="date" class="form-control" name="date" value=" {{ $u->birth }}">
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
    @endforeach
    <hr>
</div>

<!-- Modal upload image -->
<!-- <div class="modal fade" id="UploadImg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nhắc nhở</h5>
                </div>
                <div class="modal-body">
                    <div id="img_demo"></div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary btCrop">Crop</a>
                    <button class="btn btn-danger " type="button" data-dismiss="modal">Cancel</button>                    
                </div>
            </div>
        </div>
    </div> -->
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

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script> -->
<script src="{{asset('js\ajax\upload_avatar.js')}}"></script>
@endsection