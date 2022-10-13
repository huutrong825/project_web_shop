@extends('layout_admin')
@section('content')
<div class="text-center">
    <h1 class="h4 text-gray-900 mb-4">Thêm user mới</h1>
</div>
<div class="modal-body">
    <form action="/admin/user/add" class="user" method="post">  
        @csrf                      
        <div class="form-group">
            <div class="">
                <input type="text" class="form-control form-control-user" id='txtname' name="txtname"
                    placeholder="Nhập họ tên">
            </div>
            <p style="color:red" class="help is-danger">{{ $errors->first('txtname') }}</p>
        </div>
        <div class="form-group">
            <input type="email" class="form-control form-control-user" id='email' name="email"
                placeholder="Nhập Email">
                <p style="color:red" class="help is-danger">{{ $errors->first('email') }}</p>
        </div>
        <div class="form-group">
            <div class="">
                <input type="password" class="form-control form-control-user"
                    name="password" id='password' placeholder="Tạo mật khẩu mới">
            </div>
            <p style="color:red" class="help is-danger">{{ $errors->first('password') }}</p>
        </div>
        <div class="form-group">
            <div class="">
                <input type="password" class="form-control form-control-user"
                    name="repass" id='repass' placeholder="Xác nhận lại mật khẩu">
                <p style="color:red" class="help is-danger">{{ $errors->first('repass') }}</p>
            </div>
        </div>
        <div class="form-group">
            <select class="form-control " id="group_role" name="group_role" >
                <option disabled selected hidden>Chọn nhóm</option>
                <option value="1">Admin</option>
                <option value="2">Employee</option>
            </select>
            <p style="color:red" class="help is-danger">{{ $errors->first('group_role') }}</p>
        </div>
        <div class="form-group custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="active" name="active">  
            <label class="custom-control-label" for="active">Trạng thái hoạt động</label>                      
        </div>
        <div class="form-group">
            <input type='submit' class="btn btn-success btn-user btn-block" value="Thêm mới"> 
        </div>
        <div class="form-group" style="text-align:center">
            <a href='/admin/user'> <i class="fas fa-long-arrow-alt-left"></i> Quay lại</a> 
        </div>
    </form>
</div>
@endsection