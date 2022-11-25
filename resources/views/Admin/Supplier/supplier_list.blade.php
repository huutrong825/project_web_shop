@extends('layout_admin')
@section('css')
    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 style="float:left"  class="m-0 font-weight-bold text-primary">Thao tác</h6>
        <a style="float:right" class="text-success" data-toggle="collapse" data-target="#demo"><i class="fas fa-plus"></i></a>
    </div>
    <div class="card-body collapse" id="demo">
        <div class="table-responsive">
            <div class="input-group row">
                <div class="input-group mb-3 col-sm">
                    <a class="btn btn-primary btn-icon-user bt-Add" >
                        <span class="icon text-white">
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
                    <div class="col-sm">
                        <div class="input-group ">
                            <input type="text" class="form-control" id='phone' name="phone" placeholder="Nhập liên hệ">                
                        </div>                       
                    </div>
                    <div class="col-sm">
                        <div class="input-group ">
                            <input type="text" class="form-control" id='address' name="address" placeholder="Địa chỉ">                
                        </div>                       
                    </div>
                    <div class="col-sm">
                        <select class="form-control filter" id="state"  >
                            <option disabled selected hidden>Chọn trạng thái</option>
                            <option value="1">Đang hoạt động</option>
                            <option value="0">Ngưng hoạt động</option>
                        </select>
                    </div>
                </form>
                <div class="col-sm">
                    <a class="btn btn-primary" type="reset" id='btReset' title="Reset"><i class="fas fa-sync"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="alert alert-success" style="display:none">
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Nhà cung ứng hàng hóa</h6>
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
                    <form  class="user" id='formadd' >
                        <fieldset>                                                  
                            <div class="">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="namesupp" name="namesupp"
                                        placeholder="Nhập tên nhà cung ứng" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id='addressnew' name="address"
                                    placeholder="Nhập địa chỉ" required>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <input type="text" class="form-control form-control-user"
                                        name="phonenew" id='phonenew' placeholder="Nhập SĐT liên hệ" required>
                                </div>
                                <p style="color:red" class="help is-danger"></p>
                            </div>
                            <div class="form-group">
                                <button  class="btn btn-success btn-user btn-block btSubmitAdd"> Thêm mới</button> 
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
                <div class="modal-body">Xác nhận xóa nhà cung ứng <span id='nameDelete'></span></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary DeleteSupp" >Xác nhận</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>                    
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
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="">
                    <input type="hidden" class="form-control form-control-user" id='idBlock' >
                </div>
                <form method='put'>
                    @csrf
                <div class="modal-body">Xác nhận khóa/mở nhà cun ứng <span id='nameBlock'></span></div>
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
 
@endsection