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
                
                <form class="row" id="formSearch" method='post'>                
                    @csrf
                    <div class="input-group mb col-sm">
                </div>
                    <div class="col-sm-3">
                        <div class="input-group ">
                            <input type="text" class="form-control" id='keySearch' name="key" placeholder="Tên sản phẩm">                
                        </div>                       
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group ">                            
                            <input type="text" class="form-control" id='price_from' name="price_from" placeholder="Giá nhập từ">                
                        </div> 
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group ">
                            <input type="text" class="form-control" id='price_to' name="price_to" placeholder="Giá nhập đến">                
                        </div> 
                    </div>
                    <div class="col-sm-3">
                    <div >
                        <input type="text" class="form-control"
                            name="orderday" id='from-day' placeholder="Ngày nhập từ" onfocus="(this.type='date')"
                            onblur="(this.type='text')">
                    </div> 
                </div>
                <div class="col-sm-3">
                    <div >
                        <input type="text" class="form-control"
                            name="orderday" id='to-day' placeholder="Đến ngày" onfocus="(this.type='date')"
                            onblur="(this.type='text')">
                    </div> 
                </div>
                <div class=" col-sm">
                        <a class="btn btn-success" type="reset" id='btReset' title="Reset"><i class="fas fa-sync"></i></a>
                    </div>
                </form>                
                
            </div>
        </div>
    </div>
</div>

<div class="alert alert-success" style="display:none">
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 style='float:left' class="m-0 font-weight-bold text-primary">Lịch sử nhập kho</h6>
        <a style='float:right; color:green'  id="storeExcel">
            <i class="fas fa-cloud-download-alt"> Truy xuất Excel</i>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="store_pro" width="100%">
                <thead>
                    <tr>
                        <th >STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng nhập</th>
                        <th>Giá nhập</th>
                        <th>Ngày nhập</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection

@section('script')

<!-- Page level plugins -->
<script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}"></script>

<script src="{{asset('js/ajax/ajax_product.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>

<script src="{{asset('js/ajax/drop_images.js')}}" >

@endsection