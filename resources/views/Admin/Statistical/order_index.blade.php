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
                    
                </div>
                <form class="row" id="formSearch" method='post'>
                    @csrf
                    <div class="col-sm">
                        <div class="input-group ">
                            <input type="text" class="form-control"
                                name="orderday" id='orderday' placeholder="Thời gian từ" onfocus="(this.type='date')"
                                onblur="(this.type='text')">                
                        </div> 
                    </div>
                    <div class="col-sm">
                        <div class="input-group ">
                         <input type="text" class="form-control"
                                name="orderday" id='orderday' placeholder="Thời gian đến" onfocus="(this.type='date')"
                                onblur="(this.type='text')">   
                        </div> 
                    </div>
                    <div class="col-sm">
                        <select class="form-control filter" id="state"  >
                            <option disabled selected hidden>Chọn mốc thời gian</option>
                            <option value="dd">Theo ngày</option>
                            <option value="MM">Theo tháng</option>
                        </select>
                    </div>
                    <div class=" col-sm-3">
                    <a class="btn btn-success" type="reset" id='btReset' title="Reset"><i class="fas fa-sync"></i></a>
                </div>
                </form>
            </div>
        </div>
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
                        <div class="h5 mb-0 font-weight-bold text-800">$215,000</div>
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
                        <div class="h5 mb-0 font-weight-bold text-800">$215,000</div>
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
        <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
    </a>
    <div class="collapse show" id="collapseChart" width="400px" height="100px">
        <div class="card-body">
            <div class="chart-area" width="400px" height="100px">
                <canvas id="popalChart"  width="400px" height="100px"></canvas>
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

<script src="{{asset('js/ajax/overview.js')}}"></script>

    
    

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

@endsection