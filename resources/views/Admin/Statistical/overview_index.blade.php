@extends('layout_admin')
@section('css')
    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection
@section('content')
   
<div class="card shadow mb-4 raw">
    <div class="card-header py-3">
        <h4 style="float:left"  class="m-0 font-weight-bold text-primary">Thống kê tổng quan</h4>
        <select style="float:right; text-align:center" class="form-control-sm col-sm-3" id="time-filter"  >
            <option >---- Chọn ----</option>
            <option value="7ngay">Dữ liệu 7 ngày</option>
            <option value="thangtruoc">Dữ liệu tháng trước</option>
            <option value="365ngay">Dữ liệu 1 năm</option>
        </select>
    </div>
</div>

<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Doanh thu bán</div>
                        <div class="h5 mb-0 font-weight-bold text-800" id='sum_total'></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tasks Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Số lượng đã bán
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-800" id='sum_sale'></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shopping-cart fa-2x text-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tasks Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Số đơn hàng
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-800" id='sum_order'></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <!-- Earnings (Monthly) Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Số đơn hủy</div>
                        <div class="h5 mb-0 font-weight-bold text-800" id='cancel_order'></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-store-slash fa-2x text-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<div class="row">

    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Phí chi</div>
                        <div class="h5 mb-0 font-weight-bold text-800" id='fee_add'></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Số lượng nhập</div>
                        <div class="h5 mb-0 font-weight-bold text-800" id='product_add'></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-cart-plus fa-2x text-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Pending Requests Card Example -->
     <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Đơn hàng hoàn thành</div>
                        <div class="h5 mb-0 font-weight-bold text-800" id='complete_order'></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Hàng trong kho</div>
                        <div class="h5 mb-0 font-weight-bold text-800" id='quanity'></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-boxes fa-2x text-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <a href="#collapseChart" class="d-block card-header py-3" data-toggle="collapse"
        role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-primary">Thống kê nhập hàng</h6>
    </a>
    <div class="collapse show" id="collapseChart">
        <div class="card-body">
            <div class="chart-area">
            <canvas id="myChart1" style=" height:240px !important; width:380px !important;"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <a href="#collapseChart1" class="d-block card-header py-3" data-toggle="collapse"
        role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-primary">Thống kê bán hàng</h6>
    </a>
    <div class="collapse show" id="collapseChart1">
        <div class="card-body">
            <div class="chart-area">
                <canvas id="myChart" style=" height:240px !important; width:380px !important;"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- <div class="card shadow mb-4">
    <a href="#collapseTable" class="d-block card-header py-3" data-toggle="collapse"
        role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-primary">Data Table</h6>
    </a>
    <div class="collapse show" id="collapseTable">
        <div class="card-body">
            <table class="table table-bordered" id="myTable" width="100%">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div> -->

@endsection

@section('script')

<!-- Page level plugins -->
<script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}"></script>

<script src="{{asset('js/ajax/overview.js')}}"></script>

    <!-- Page level plugins -->
    <!-- <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script> -->

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

@endsection