@extends('layout_admin')
@section('css')
    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 style="float:left"  class="m-0 font-weight-bold text-primary">Thống kê đơn hàng</h4>
        <a style="float:right" class="text-success" data-toggle="collapse" data-target="#demo"><i class="fas fa-plus"></i></a>
    </div>
    <div class="card-body collapse" id="demo">
        <div class="table-responsive">
            <div class="input-group row">
                <div class="input-group mb-3 col-sm-3">
                    
                </div>
                <form class="row" id="formSearch" >
                    <div class="col-sm">
                        <div class="input-group ">
                            <input type="text" class="form-control"
                                name="fromDate" id='fromDate' placeholder="Thời gian từ" onfocus="(this.type='date')"
                                onblur="(this.type='text')">                
                        </div> 
                    </div>
                    <div class="col-sm">
                        <div class="input-group ">
                         <input type="text" class="form-control"
                                name="toDate" id='toDate' placeholder="Thời gian đến" onfocus="(this.type='date')"
                                onblur="(this.type='text')">   
                        </div> 
                    </div>
                    <!-- <div class="col-sm">
                        <select class="form-control filter" id="type"  >
                            <option disabled selected hidden>Chọn mốc thời gian</option>
                            <option value="dd">Theo ngày</option>
                            <option value="MM">Theo tháng</option>
                        </select>
                    </div> -->
                    <div class=" col-sm-3">
                        <a class="btn btn-success" type="reset" id='btReset' title="Reset"><i class="fas fa-sync"></i></a>
                    </div>
                </form>
                <div class=" col-sm-3">
                    <a class="btn btn-success" type="reset" id='btPDF' title="PDF"><i class="fas fa-cloud-download-alt"></i>PDF</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div  id='detailPDF'>
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Tổng đơn hàng</div>
                        <div class="h5 mb-0 font-weight-bold text-800" id='sum_order'></div>
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
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tổng sản phẩm bán ra
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-800" id='sum_prod'></div>
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
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Số sản phẩm có đơn hàng
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-800" id='num_prod'></div>
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
   <!-- <div class="col-xl-3 col-md-6 mb-4">
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
    </div> -->
    
</div>

<div class="card shadow mb-4">
    <a href="#collapseChart" class="d-block card-header py-3" data-toggle="collapse"
        role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-primary">Thống kê trạng thái đơn hàng</h6>
    </a>
    <div class="collapse show" id="collapseChart">
        <div class="card-body">
            <div class="chart-area">
                <canvas id="doughnutChart" style=" height:240px !important; width:380px !important;"></canvas>
            </div>
        </div>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-bordered" id="myTable" width="100%">
                    <thead> 
                        <a class="btn bt-success dropdown-item col-sm" id="exportExcel">
                            <i class="fas fa-cloud-download-alt"> Truy xuất</i>
                        </a>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Doanh thu bán được</th>
                            <th>Số lượng bán</th>
                            <th>Số đơn hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
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


<!-- Page level custom scripts -->
<script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="{{asset('js\ajax\ajax_order_sta.js')}}"></script> 
    

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

@endsection