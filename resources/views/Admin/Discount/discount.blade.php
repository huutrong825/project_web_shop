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
    <div class="input-group mb-3 col-sm-3">
        <a class="btn btn-success btn-icon-user btLink" >
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Gắn sản phẩm</span>
        </a>
    </div>
    <!-- <form class="row" id="formSearch">
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
    <div class="col-sm-3">
        <a class="btn btn-primary" type="reset" id='btReset' title="Reset"><i class="fas fa-sync"></i></a>
    </div>
    </form> -->
</div>
<div class="alert alert-success" style="display:none">
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Khuyến mãi</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="myTable" width="100%">
                <thead>
                    <tr>
                        <th >STT</th>
                        <th>Chương trình khuyến mãi</th>
                        <th>Loại khuyến mãi</th>
                        <th>Giá trị áp dụng</th>
                        <th>Thời gian áp dụng</th>
                        <th>Thời gian kết thúc</th>
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
    <div class="modal fade" id="AddDiscount" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content add-user">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Thêm chương trình khuyến mãi</h1>
                </div>
                <div class="modal-body">
                    <form  class="user" id='formadd' >
                        <fieldset>                                                  
                            <div class="">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="namedis" name="namedis"
                                        placeholder="Nhập tên chương trình khuyến mãi" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <select class="form-control select" id="typedis" name='typedis' required>
                                    <option disabled selected hidden>Chọn loại khuyến mãi</option>
                                    <option value="1">Giảm theo % giá trị</option>
                                    <option value="2">Giảm theo số tiền</option>
                                    <option value="3">Sản phẩm tặng kèm</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <input type="text" class="form-control form-control-user"
                                        name="value" id='value' placeholder="Giá trị khuyến mãi áp dụng" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <input type="text" class="form-control form-control-user"
                                        name="startday" id='startday' placeholder="Ngày bắt đầu" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <input type="text" class="form-control form-control-user"
                                        name="endday" id='endday' placeholder="Ngày kết thúc" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                                </div>
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

    <!-- Link Product Modal -->
    <div class="modal fade" id="LinkProduct" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content add-user">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Gắn khuyến mãi sản phẩm</h1>
                </div>
                <div class="modal-body">
                    <form  class="user" id='form-link' >
                        <fieldset class="row"> 
                            <div class="form-group col-sm-6">
                                <select class="form-control select" id="namedis" name='namedis' required>
                                    <option disabled selected hidden>Chọn khuyến mãi</option>
                                    @foreach ($disc as $d)
                                    <option value="{{ $d->dis_id }}">{{ $d->dis_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <select class="form-control select" id="product" name='product' required>
                                    <option disabled selected hidden>Chọm sản phẩm</option>
                                    @foreach( $pro as $p)
                                    <option value="{{ $p->product_id }}">{{ $p->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>
                        <div class="">
                            <button type='submit' class="btn btn-success btn-user btn-block btSubmitLink"> Thêm mới</button> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Supplier Modal -->
    <div class="modal fade" id="UpdateDis" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content add-user">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Cập nhật chương trình khuyến mãi</h1>
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
                        <div class="">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="nameUp" name="nameUp"
                                     required>
                            </div>
                        </div>
                        <div class="form-group">
                            <select class="form-control select" id="typedisUp" name='typedisUp' required>
                                <option selected id='typeOld'></option>
                                <option value="1">Giảm theo % giá trị</option>
                                <option value="2">Giảm theo số tiền</option>
                                <option value="3">Sản phẩm tặng kèm</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="">
                                <label>Giá trị khuyến mãi</label>
                                <input type="text" class="form-control form-control-user"
                                    name="valueUp" id='valueUp' placeholder="Giá trị khuyến mãi áp dụng" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="">
                                <label>Ngày áp dụng</label>
                                <input type="date" class="form-control form-control-user"
                                    name="startdayUp" id='startdayUp' required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="">
                                <label>Ngày kết thúc</label>
                                <input type="date" class="form-control form-control-user"
                                    name="enddayUp" id='enddayUp'   required>
                            </div>
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
                <div class="modal-body">Xác nhận xóa khuyến mãi <span id='nameDelete'></span></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary DeleteDis" >Xác nhận</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>                    
                </div>
            </div>
        </div>
    </div>  
    
    <!-- Block Modal-->
    <div class="modal fade" id="BlockDis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form >
                    <div class="modal-body">Xác nhận đóng khuyến mãi  <span id='nameBlock'></span></div>
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

<script src="{{asset('js/ajax/ajax_discount.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
 
@endsection