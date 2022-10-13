@extends('layout_admin')
@section('content')
<div class="text-center">
    <h1 class="h4 text-gray-900 mb-4">Chỉnh sửa User</h1>
</div>
@if(session('thongbao'))
    <div class="alert alert-success">
        {{session('thongbao')}}
    </div>
@endif
<div class="modal-body">
    <form action="/admin/user/fix/{{ $user->id }}" class="user" method="post" enctype="multipart/form-data">  
        @csrf                      
        <div class="form-group">
            <div class="">
                <input type="text" class="form-control form-control-user" id='txtname' name="txtname" value="{{ $user->name }}">
            </div>
        </div>
        <div class="form-group">
            <input type="email" class="form-control form-control-user" id='email' name="email"
                value="{{ $user->email }}" disabled>
        </div>
        <div class="form-group">
            <select class="form-control " id="group_role" name="group_role" >
                <option  selected value="{{ $user->group_role}}" ><?php echo ($user->group_role==1)?'Admin':'Employee' ?></option>
                <option value="1">Admin</option>
                <option value="2">Employee</option>
            </select>
        </div>
        <div class=" form-group custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck" name="checkPass">
            <label class="custom-control-label" for="customCheck">Thay đổi mật khẩu</label>
        </div>        
        <div class="form-group" id='pass1' style="display:none">
            <div class="">
                <input type="password" class="form-control form-control-user"
                    name="password" id='password' placeholder="Nhập mật khẩu cũ">
            </div>
            <p style="color:red" class="help is-danger">{{ $errors->first('password') }}</p>
        </div>
        <div class="form-group" id='pass2' style="display:none">
            <div class="">
                <input type="password" class="form-control form-control-user"
                    name="newpass" id='newpass' placeholder="Nhập mật khẩu mới">
            </div>
            <p style="color:red" class="help is-danger">{{ $errors->first('newpass') }}</p>
        </div>
        <div class="form-group" id='pass3' style="display:none">
            <div class="">
                <input type="password" class="form-control form-control-user"
                    name="renewpass" id='renewpass' placeholder="Xác nhận lại mật khẩu mới">
                <p style="color:red" class="help is-danger">{{ $errors->first('renewpass') }}</p>
            </div>
        </div>        
        <div class="form-group">
            <input type='submit' class="btn btn-success btn-user btn-block" value="Lưu"> 
        </div>
        <div class="form-group" style="text-align:center">
            <a href='/admin/user'> <i class="fas fa-long-arrow-alt-left"></i> Quay lại</a> 
        </div>
    </form>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function (){
        $("#customCheck").click(function(){
            $("#pass1").toggle();
            $("#pass2").toggle();
            $("#pass3").toggle();
        });
    });
</script>
@endsection