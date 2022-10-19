@extends('layout_admin')
@section('css')
    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">

    
@endsection
@section('content')
<div class="input-group">
    <div class="input-group mb-3">
        <a href='#' class="btn btn-primary btn-icon-user" data-toggle="modal" data-target="#AddUserModal">
            <span class="icon text-white-50">
                <i class="fas fa-user-plus"></i>
            </span>
            <span class="text">Thêm mới</span>
        </a>
    </div>
    <form active="/admin/user" method="get">
    <div class="input-group mb-3">
        <input type="text" class="form-control" id='key' name="key" placeholder="Search">
        <div class="input-group-append">
            <button class="btn btn-success" type="submit" id='btSearch'>Go</button>
        </div>
    </div>
    </form>
</div>
@if(session('thongbao'))
    <div class="alert alert-success">
        {{session('thongbao')}}
    </div>
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">User</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%">
                <thead>
                    <tr>
                        <th style="display:none"></th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Nhóm</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user as $u)
                    <tr>
                        <td style="display:none">{{ $u->id }}</td>
                        <td class='name'>{{ $u->name }}</td>
                        <td  class='email'>{{ $u->email }}</td>
                        <td class='group_role'> 
                        @switch($u->group_role)
                            @case(1)
                                Admin
                                @break
                            @case(2)
                                Employee
                                @break
                            @default
                                Errol
                        @endswitch
                        </td>
                        @switch($u->is_active)
                            @case(0)
                                <td style='color:red'>Tạm khóa</td>
                                @break
                            @case(1)
                                <td style='color:green'>Đang hoạt động</td>
                                @break
                            @default
                             <td>Errol</td>
                        @endswitch
                        <td>
                            <a href='' value='{{$u->id}}'  class="btn btn-success btn-circle btn-sm btUpdate">
                                <i class="fas fa-pen"></i>
                            </a>
                            <a href='/admin/user/delete/{{$u->id}}' class="btn btn-danger btn-circle btn-sm" >
                                <i class="fas fa-trash"></i>
                            </a>
                            <a href='/admin/user/block/{{$u->id}}' class="btn btn-warning btn-circle btn-sm">
                                <i class="fas fa-user-times"></i>
                            </a>
                        </td>
                        <!-- Delete Modal-->
                        <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nhắc nhở</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Xác nhận xóa người dùng {{ $u->name }}!</div>
                                    <div class="modal-footer">
                                        <a class="btn btn-primary" href="/admin/user/delete/{{$u->id}}">Xác nhận</a>
                                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>                    
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </tr>                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


    <!-- Add User Modal-->
    @include('Admin.User.add_user')

    <!-- Update User Model -->
    <div class="modal fade" id="UpdateUserModal" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content add-user">
        <div class="modal-header">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Chỉnh sửa User</h1>
        </div>
        <div class="modal-body">
               
                <div class="form-group">
                    <div class="">
                        <input type="hidden" class="form-control form-control-user" id='ID' >
                    </div>
                </div>  
                <div class="form-group">
                    <div class="">
                        <input type="text" class="form-control form-control-user" id='nameUpdate' name="txtname" >
                    </div>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control form-control-user" id='emailUpdate' name="email"
                        value="" disabled>
                </div>
                <div class="form-group">
                    <select class="form-control " id="role" name="group_role" >
                        <option  selected id='txtrole'></option>
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
                            name="password" id='oldpass' placeholder="Nhập mật khẩu cũ">
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
                    <input type='submit' id='submitUpdate' class="btn btn-success btn-user btn-block" value="Lưu"> 
                </div>
        </div>
    </div>
</div>
</div>

{{$user->links()}}
@endsection

@section('script')
<!-- Page level plugins -->
<script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->



<script src="{{asset('js/ajax/update_user.js')}}"></script>

@endsection