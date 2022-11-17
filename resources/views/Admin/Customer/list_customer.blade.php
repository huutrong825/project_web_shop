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
                            <input type="text" class="form-control" id='keySearch' name="key" placeholder="Nhập tên">                
                        </div> 
                    </div>
                    <div class="col-sm">
                        <div class="input-group ">
                            <input type="text" class="form-control" id='phone' name="phone" placeholder="Nhập liên hệ">                
                        </div> 
                    </div>
                    <div class="col-sm">
                        <div class="input-group ">
                            <input type="text" class="form-control" id='email' name="email" placeholder="Email">                
                        </div>                       
                    </div>
                    <div class="col-sm">
                        <div class="input-group ">
                            <input type="text" class="form-control" id='address' name="address" placeholder="Địa chỉ">                
                        </div>
                    </div>
                </form>
                <div class="col-sm-3">
                    <a class="btn btn-primary" type="reset" id='btReset' title="Reset"><i class="fas fa-sync"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 style='float:left' class="m-0 font-weight-bold text-primary">Danh sách khách hàng</h6>
        <div class="dropdown" style='float:right'>
            <button type="button" class="text-success btn bt-success dropdown-toggle" data-toggle="dropdown">
                <i class="fas fa-cloud-download-alt"> Truy xuất</i>
            </button>
            <div class="dropdown-menu">
                <a class="btn bt-success dropdown-item" id="exportExcel" value='.xlsx'>File (.xlsx)</a>
                <!-- <a href='/admin/customer/exportPDF'class="btn bt-success dropdown-item " id="exportPDF">File (.pdf)</a> -->
            </div>
        </div>
        
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="myTable" width="100%">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên khách hàng</th>
                        <th>Email</th>
                        <th>Liên hệ</th>
                        <th>Địa chỉ</th>
                        <th>Số đơn đặt</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

    


    <!-- Add Supplier Modal-->
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
                    <h1 class="h4 text-gray-900 mb-4">Thêm khách hàng</h1>
                </div>
                <div class="modal-body">
                    <form id="addForm" method="post" class="user">
                    <fieldset>
                        @csrf                      
                        <div class="form-group">
                            <div class="form-group">
                                <div class="">
                                    <input type="text" class="form-control form-control-user" id='name' name="name" placeholder='Tên khách hàng'>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <input type="text" class="form-control form-control-user" id='email' name="email" placeholder='Nhập email'>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <input type="text" class="form-control form-control-user" id='phone' name="phone" placeholder='Nhập số điện thoại'>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <input type="text" class="form-control form-control-user" id='address' name="address" placeholder='Nhập địa chỉ'>
                                </div>
                            </div>
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
                    <h1 class="h4 text-gray-900 mb-4">Cập nhật thông tin khách hàng</h1>
                </div>
                <div class="alert alert-success" style="display:none">
                </div>
                <div class="modal-body">
                    <form class="user" id='formUpdate' method="put">
                    <fieldset>
                        @csrf
                        <div class="form-group">
                            <div class="">
                                <input type="hidden" class="form-control form-control-user" id='idUp' >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="">
                                <input type="text" class="form-control form-control-user" id='nameUp' name="nameUp">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="">
                                <input type="text" class="form-control form-control-user" id='emailUp' name="emailUp">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="">
                                <input type="text" class="form-control form-control-user" id='phoneUp' name="phoneUp">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="">
                                <input type="text" class="form-control form-control-user" id='addressUp' name="addressUp">
                            </div>
                        </div>
                        <div class="form-group">
                            <a type='submit' class="btn btn-success btn-user btn-block btSubmitUpdate">Cập nhật</a> 
                        </div>
                    </fieldset>
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
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}"></script>

<script src="{{asset('js/ajax/ajax_customer.js')}}"></script>
<script src="{{asset('js/ajax/tableToExcel.js')}}"></script>
<script src=
"//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
 <!-- Page level custom scripts -->
    
@endsection