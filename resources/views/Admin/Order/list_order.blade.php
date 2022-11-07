@extends('layout_admin')
@section('css')
    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection
@section('content')

<div class="input-group row">
    <div class="input-group mb-3 col-sm-3">
        <a href="/admin/product/add" class="btn btn-primary btn-icon-user" >
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Thêm mới</span>
        </a>
    </div>
    <form class="row" id="formSearch" method='post'>
        @csrf
        <div class="col-sm">
            <div class="input-group ">
                <input type="text" class="form-control" id='keySearch' name="key" placeholder="Search">                
            </div>                       
        </div>
        <div class="col-sm">
            <div class="input-group ">
                
                <input type="text" class="form-control" id='price_from' name="price_from" placeholder="Giá bán từ">                
            </div> 
        </div>
        <div class="col-sm">
            <div class="input-group ">
                <input type="text" class="form-control" id='price_to' name="price_to" placeholder="Giá bán đến">                
            </div> 
        </div>
        <div class="col-sm">
            <select class="form-control filter" id="state"  >
                <option disabled selected hidden>Chọn trạng thái</option>
                <option value="1">Đang bán</option>
                <option value="o">Ngừng bán</option>
            </select>
        </div>
        <div class=" col-sm-3">
        <a class="btn btn-success" type="reset" id='btReset' title="Reset"><i class="fas fa-sync"></i></a>
    </div>
    </form>
    
</div>

   

<div class="alert alert-success" style="display:none">
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Sản phẩm</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="myTable" width="100%">
                <thead>
                    <tr>
                        <th >STT</th>
                        <th>Khách hàng</th>
                        <th>Ngày đặt</th>
                        <th>Ngày nhận</th>
                        <th>Loại hình thanh toán</th>
                        <th>Giá trị đơn hàng</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Detail  Modal -->
<div class="modal fade" id="DetailOrder" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content add-user">
                <div class="modal-header" >
                    <h1 class="h2 text-green mb-4">Chi tiết đơn hàng</h1>
                </div>
                <div></div>
                <div class="modal-body detail">
                    <div class='' >
                        <div>
                            <span> Người nhận</span>
                            <p id='cus_name'></p>
                        </div>
                        <div>
                            <span> Địa chỉ nhận</span>
                            <p id='address'></p>
                        </div>
                    </div>
                    <div class=''>
                        <table class="table table-hover" id="DetailTable" width="100%">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table
                    ></div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="{{asset('js/ajax/ajax_order.js')}}"></script>
@endsection