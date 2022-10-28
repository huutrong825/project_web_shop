@extends('layout_admin')
@section('css')
    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="input-group row">
    <div class="input-group mb-3 col-sm-3">
        <a class="btn btn-primary btn-icon-user bt-Add" >
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
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
    <!-- <div class="col-sm">
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
            <option value="o">Ngưng hoạt động</option>
        </select>
    </div> -->
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
        <h6 class="m-0 font-weight-bold text-primary">Home >> Nhà cung ứng hàng hóa</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="myTable" width="100%">
                <thead>
                    <tr>
                        <th >STT</th>
                        <th>Tên nhà cung ứng</th>
                        <th>Địa chỉ</th>
                        <th>Liên hệ</th>
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

    


    <!-- Add Supplier Modal -->
    <div class="modal fade" id="AddModal" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content add-user">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Thêm nhà cung ứng mới</h1>
                </div>
                <div class="modal-body">
                    <form action="/admin/supplier/add" class="user" id='formadd' method="post">
                    <fieldset>
                        @csrf                      
                        <div class="form-group">
                            <div class="">
                                <input type="text" class="form-control form-control-user" id='txtname' name="txtname"
                                    placeholder="Nhập tên nhà cung ứng" required>
                            </div>
                            <p style="color:red" class="help is-danger"></p>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id='address' name="address"
                                placeholder="Nhập địa chỉ" required>
                                <p style="color:red" class="help is-danger"></p>
                        </div>
                        <div class="form-group">
                            <div class="">
                                <input type="text" class="form-control form-control-user"
                                    name="phone" id='phone' placeholder="Nhập SĐT liên hệ" required>
                            </div>
                            <p style="color:red" class="help is-danger"></p>
                        </div>
                        <div class="form-group custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="state" name="state">  
                            <label class="custom-control-label" for="state">Trạng thái cung ứng hàng</label>                      
                        </div>
                        <div class="form-group">
                            <input type='submit' class="btn btn-success btn-user btn-block btSubmitAdd" value="Thêm mới"> 
                        </div>
                    </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Supplier Modal -->
    <div class="modal fade" id="UpdateModal" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content add-user">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Cập nhật nhà cung ứng mới</h1>
                </div>
                <div class="alert alert-success" style="display:none">
                </div>
                <div class="modal-body">
                    <form class="user" id='form' method="put">
                    <fieldset>
                        @csrf
                        <div class="form-group">
                            <div class="">
                                <input type="hidden" class="form-control form-control-user" id='idUp' >
                            </div>
                        </div>                      
                        <div class="form-group">
                            <div class="">
                                <input type="text" class="form-control form-control-user" id='nameUp' name="txtname"
                                     required>
                            </div>
                            <p style="color:red" class="help is-danger"></p>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id='addressUp' name="address">
                            <p style="color:red" class="help is-danger"></p>
                        </div>
                        <div class="form-group">
                            <div class="">
                                <input type="text" class="form-control form-control-user"
                                    name="phone" id='phoneUp'  required>
                            </div>
                            <p style="color:red" class="help is-danger"></p>
                        </div>
                        <div class="form-group">
                            <a type='submit' class="btn btn-success btn-user btn-block btSubmitUpdate" >Lưu</a> 
                        </div>
                    </fieldset>
                    </form>
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
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="">
                    <input type="hidden" class="form-control form-control-user" id='idDelete' >
                </div>
                <form method='delete'>
                    @csrf
                <div class="modal-body">Xác nhận xóa người dùng <span id='nameDelete'></span></div>
                <div class="modal-footer">
                    <a class="btn btn-primary btSubmitDelete" >Xác nhận</a>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>                    
                </div>
                </form>
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
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="">
                    <input type="hidden" class="form-control form-control-user" id='idBlock' >
                </div>
                <form method='put'>
                    @csrf
                <div class="modal-body">Xác nhận khóa/mở người dùng <span id='nameBlock'></span></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btSubmitBlock" >Xác nhận</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>                    
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')

<!-- Page level plugins -->
<script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}"></script>

<script src="{{asset('js/ajax/ajax_supplier.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
 <!-- Page level custom scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"></script>
@endsection