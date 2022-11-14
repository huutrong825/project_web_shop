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
            <div class="input-group mb-3 col-sm row">
                <form class="row" id="formSearch" method='post'>
                    @csrf
                    <div class="col-sm">
                        <div class="input-group ">
                            <input type="text" class="form-control" id='keySearch' name="key" placeholder="Search">                
                        </div>
                    </div>
                    <div class="col-sm">
                        <div >
                            <input type="text" class="form-control"
                                name="orderday" id='orderday' placeholder="Thời gian đặt" onfocus="(this.type='date')"
                                onblur="(this.type='text')">
                        </div> 
                    </div>
                    <div class="col-sm">
                        <select class="form-control filter" id="type_payment"  >
                            <option disabled selected hidden>Chọn trạng thái</option>
                            <option value="1">Chuyển khoản</option>
                            <option value="2">COD</option>
                        </select>
                    </div>
                    <div class="col-sm">
                        <select class="form-control filter" id="state"  >
                            <option disabled selected hidden>Chọn trạng thái</option>
                            @foreach( $ostate as $o)
                                @if ($o->id <= 4)
                                    <option value="{{ $o->id }}">{{ $o->state_name }}</option>
                                @endif
                            @endforeach
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

<div class="alert alert-success" style="display:none">
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Xử lý đơn hàng</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="processTable" width="100%">
                <thead>
                    <tr>
                        <th >Đơn hàng</th>
                        <th>Khách hàng</th>
                        <th>Thời gian đặt</th>
                        <th>Loại hình thanh toán</th>
                        <th>Giá trị đơn hàng</th>
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

    <!-- Detail  Modal -->
    <div class="modal fade" id="DetailOrder" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content add-user">
                <div class="modal-header" >
                    <h1 class="h2 text-green mb-4">Chi tiết đơn hàng</h1>
                    <a  class="text-success btn bt-success btExportPDF"><i class="fas fa-cloud-download-alt"> Truy xuất PDF</i></a>
                </div>
                <div></div>
                <div class="modal-body" id='detailPDF'>
                    <div style="height:auto" >
                        <div>
                            <span> Người nhận:  </span>
                            <span id='cus_name'></span>
                        </div>
                        <div>
                            <span>Ngày đặt hàng:  </span>
                            <lable id='time'></lable>
                        </div>
                        <div>
                            <span> Số điện thoại :  </span>
                            <lable id='phone'></lable>
                        </div>
                        <div>
                            <span> Địa chỉ nhận :  </span>
                            <lable id='address'></lable>
                        </div>
                        <div>
                            <span> Email :  </span>
                            <lable id='email'></lable>
                        </div>
                        <div>
                            <span> Ghi chú :  </span>
                            <lable id='notes'></lable>
                        </div>
                    </div>
                    <div class=''  style="margin-top: 50px;" >
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
                        </table>
                    </div>
                    <div style="height:120px">
                        <span> Tổng tiền:  </span>
                        <lable style="float:right; margin-right:180px" id='Total'></lable>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="{{asset('js/ajax/ajax_order.js')}}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
@endsection