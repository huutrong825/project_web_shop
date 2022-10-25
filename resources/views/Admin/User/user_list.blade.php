@extends('layout_admin')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">    
@endsection

@section('content')
    <div class="input-group">
        <div class="input-group mb-3">
            <a class="btn btn-primary btn-icon-user btAddUser" >
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
            <div class="input-group-append">
                <a href='/admin/user' class='btn btReload'><i class='fas fa-sync-alt'></i></a>
            </div>
        </div>
        </form>
    </div>
    <div class="alert alert-success" style="display:none">
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
                                <a value='{{$u->id}}'  class="btn btn-success btn-circle btn-sm btUpdate">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <a value='{{$u->id}}' class="btn btn-danger btn-circle btn-sm btDelete" >
                                    <i class="fas fa-trash"></i>
                                </a>
                                <a value='{{$u->id}}' class="btn btn-warning btn-circle btn-sm btBlock">
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
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul id='error_mes'></ul>
                </div>
                <div class="modal-body form-add">  
                    <form class="form-group" id='form-add-user'>
                        <fieldset>                
                            <div class="form-group">
                                <div class="">
                                    <input type="text" class="form-control form-control-user" id='addtxtname' name="txtname"
                                        placeholder="Nhập họ tên" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id='addemail' name="email"
                                    placeholder="Nhập Email" required>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <input type="password" class="form-control form-control-user"
                                        name="password" id='addpassword' placeholder="Tạo mật khẩu mới" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <input type="password" class="form-control form-control-user"
                                        name="repass" id='addrepass' placeholder="Xác nhận lại mật khẩu" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <select class="form-control " id="addgroup_role" name="group_role" required>
                                    <option disabled selected hidden>Chọn nhóm</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Employee</option>
                                </select>
                            </div>
                            <div class="form-group custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="addactive" name="addactive">  
                                <label class="custom-control-label" for="addactive">Trạng thái hoạt động</label>                      
                            </div>
                            <div class="form-group">
                                <input id='btSubmitAdd' class="btn btn-success btn-user btn-block " value="Thêm mới"> 
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                <div class="alert alert-danger print-error-up" style="display:none">
                    <ul id='error_up'></ul>
                </div> 
                <div class="modal-body">
                    <form id='formUpdate'>
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
                        <div class="form-group" id='pass1' style="display:none" >
                            <div class="">
                                <input type="password" class="form-control form-control-user"
                                    name="password" id='oldpass' placeholder="Nhập mật khẩu cũ">
                            </div>
                        </div>
                        <div class="form-group" id='pass2' style="display:none">
                            <div class="">
                                <input type="password" class="form-control form-control-user"
                                    name="newpass" id='newpass' placeholder="Nhập mật khẩu mới">
                            </div>
                        </div>
                        <div class="form-group" id='pass3' style="display:none">
                            <div class="">
                                <input type="password" class="form-control form-control-user"
                                    name="renewpass" id='renewpass' placeholder="Xác nhận lại mật khẩu mới">
                            </div>
                        </div>        
                        <div class="form-group">
                            <input type='submit' id='submitUpdate' class="btn btn-success btn-user btn-block" value="Lưu"> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Block Modal-->
    <div class="modal fade" id="BlockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nhắc nhở</h5>
                </div>
                <div class="">
                    <input type="hidden" class="form-control form-control-user" id='idBlock' >
                </div>
                <div class="modal-body">Xác nhận khóa/mở người dùng <span id='nameBlock'></span></div>
                <div class="modal-footer">
                    <a class="btn btn-primary btDSubmitBlock">Xác nhận</a>
                    <button class="btn btn-danger " type="button" data-dismiss="modal">Cancel</button>                    
                </div>
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
                </div>
                <div class="">
                    <input type="hidden" class="form-control form-control-user" id='idDelete' >
                </div>
                <div class="modal-body">Xác nhận xóa người dùng <span id='nameDelete'></span></div>
                <div class="modal-footer">
                    <a class="btn btn-primary btDSubmitDelete">Xác nhận</a>
                    <button class="btn btn-danger " type="button" data-dismiss="modal">Cancel</button>                    
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
<script src="{{asset('js/ajax/ajax_user.js')}}"></script>

<script src="{{asset('js\demo\datatables-demo.js')}}"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
@endsection