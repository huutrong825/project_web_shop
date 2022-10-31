@extends('layout_admin')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">    
@endsection

@section('content')
    <div class="input-group row">
        <div class="input-group mb-3 col-sm-3">
            <a class="btn btn-primary btAddUser" >
                <span class="icon text-white-50">
                    <i class="fas fa-user-plus"></i>
                </span>
                <span class="text">Thêm mới</span>
            </a>
        </div>
        <form class="row" id="formSearch">
        <div class="col-sm">
            <div class="input-group ">
                <input type="text" class="form-control" id='keySearch' name="key" placeholder="Search">                
            </div>                       
        </div>
        <div class="col-sm">
            <select class="form-control filter" id="group"  >
                <option disabled selected hidden>Chọn nhóm</option>
                <option value="1">Admin</option>
                <option value="2">Employee</option>
            </select>
        </div>
        <div class="col-sm">
            <select class="form-control filter" id="active"  >
                <option disabled selected hidden>Chọn trạng thái</option>
                <option value="1">Đang hoạt động</option>
                <option value="0">Ngưng hoạt động</option>
            </select>
        </div>
        <div class="col-sm-3">
            <a class="btn btn-success" type="submit" id='btSearch'>Tìm</a>
        </div>
        </form>
        <div class=" col-sm-3">
            <a class="btn btn-primary" type="reset" id='btReset' title="Reset"><i class="fas fa-sync"></i></a>
        </div>
    </div>
    <div class="alert alert-success" style="display:none">
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Home >> User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="myTable" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Nhóm</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Add User Modal-->
    <div class="modal  fade" id="AddUserModal" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog " role="document">
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
                    <form class="form-group" id='formadduser'>
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
                                <a id='btSubmitAdd' class="btn btn-success btn-user btn-block ">Thêm mới</a>
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



<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
@endsection