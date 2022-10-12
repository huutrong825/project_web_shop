@extends('layout_admin')
@section('css')
    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection
@section('content')
<div>
    <div class="input-group">
        <a href='#' class="btn btn-primary btn-icon-user" data-toggle="modal" data-target="#AddUserModal">
            <span class="icon text-white-50">
                <i class="fas fa-user-plus"></i>
            </span>
            <span class="text">Thêm mới</span>
        </a>
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search">
        <div class="input-group-append">
            <button class="btn btn-success" type="submit">Go</button>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">User</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%">
                <thead>
                    <tr>

                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Nhóm</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admin as $ad)
                    <tr>
                        <td>{{ $ad->name }}</td>
                        <td>{{ $ad->email }}</td>
                        @switch($ad->group_role)
                            @case(1)
                                <td>Admin</td>
                                @break
                            @case(2)
                                <td>Employee</td>
                                @break
                        @endswitch
                        @switch($ad->is_active)
                            @case(0)
                                <td style='color:red'>Tạm khóa</td>
                                @break
                            @case(1)
                                <td style='color:green'>Đang hoạt động</td>
                                @break
                        @endswitch
                        <td>
                            <a href='#' class="btn btn-success btn-circle btn-sm">
                                <i class="fas fa-pen"></i>
                            </a>
                            <a href='#' class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#DeleteModal">
                                <i class="fas fa-trash"></i>
                            </a>
                            <a href='#' class="btn btn-warning btn-circle btn-sm">
                                <i class="fas fa-user-times"></i>
                            </a>
                        </td>                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

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
                <div class="modal-body">Xác nhận xóa người dùng XXX!</div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="#">Xác nhận</a>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>                    
                </div>
            </div>
        </div>
    </div>


    <!-- Add User Modal-->
    <div class="modal fade" id="AddUserModal" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content add-user">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Thêm user mới</h1>
                </div>
                <div class="modal-body">
                    <form class="user">                        
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
                                    name="password" id='password' placeholder="Nhập mật khẩu">
                            </div>
                            <p style="color:red" class="help is-danger">{{ $errors->first('password') }}</p>
                        </div>
                        <div class="form-group">
                            <div class="">
                                <input type="password" class="form-control form-control-user"
                                    name="repass" id='repass' placeholder="Xác nhận lại mật khẩu">
                            </div>
                        </div>
                        <div class="form-group">
                            <select class="form-control " id="group_role" name="group_role" >
                                <option disabled selected hidden>Chọn nhóm</option>
                                <option value="1">Admin</option>
                                <option value="2">Employee</option>
                            </select>
                        </div>
                        <div class="form-group custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="active" name="active">
                            <label class="custom-control-label" for="active">Trạng thái hoạt động</label>
                        </div>
                        <div>
                            <button id="add_user" class="btn btn-success btn-user btn-block">
                                Thêm
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<!-- Page level plugins -->
<script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('js/demo/datatables-demo.js')}}"></script>


<script src="{{asset('js/ajax/add_user.js')}}"></script>

@endsection