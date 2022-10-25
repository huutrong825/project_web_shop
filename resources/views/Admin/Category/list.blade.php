@extends('layout_admin')
@section('css')
    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="input-group">
    <div class="input-group mb-3">
        <a href='#' class="btn btn-primary btn-icon-user" data-toggle="modal" data-target="#AddSupplierModal">
            <span class="icon text-white-50">
                <i class="fas fa-user-plus"></i>
            </span>
            <span class="text">Thêm mới</span>
        </a>
    </div>
    <form active="/admin/user" method="get">
    <div class="input-group mb-3">
        <input type="text" class="form-control" id='txtSearch' name="txtSearch" placeholder="Search">
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
        <h6 class="m-0 font-weight-bold text-primary">Danh mục hàng hóa</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="myTable" width="100%">
                <thead>
                    <tr>
                        <th  >STT</th>
                        <th>Mặt hàng kinh doanh</th>
                        <th>Hình ảnh</th>
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
                    <h1 class="h4 text-gray-900 mb-4">Thêm loại hàng</h1>
                </div>
                <div class="modal-body">
                    <form action="/admin/category/add" class="user" method="post">  
                        @csrf                      
                        <div class="form-group">
                            <div class="">
                                <input type="text" class="form-control form-control-user" id='txtname' name="txtname"
                                    placeholder="Nhập tên loại hàng">
                            </div>
                            <p style="color:red" class="help is-danger">{{ $errors->first('txtname') }}</p>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id='address' name="address"
                                placeholder="Nhập địa chỉ">
                                <p style="color:red" class="help is-danger">{{ $errors->first('address') }}</p>
                        </div>
                        <div class="form-group">
                            <input type='submit' class="btn btn-success btn-user btn-block" value="Thêm mới"> 
                        </div>
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
                </div>
                <form method='delete'>
                    @csrf
                    <div class="">
                        <input type="hidden" class="form-control form-control-user" id='idDel' >
                    </div>
                    <div class="modal-body">Xác nhận hủy bán loại hàng <span id='nameDel'></span></div>
                    <div class="modal-footer">
                        <a class="btn btn-primary btSubmitDelete" >Xác nhận</a>
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

<script src="{{asset('js/ajax/ajax_category.js')}}"></script>
@endsection