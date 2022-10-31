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
        <div class="col-sm-3">
            <a class="btn btn-success" type="submit" id='btSearch'>Tìm</a>
        </div>
    </form>
    <div class=" col-sm-3">
        <a class="btn btn-primary" type="reset" id='btReset' title="Reset"><i class="fas fa-sync"></i></a>
    </div>
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
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Hình ảnh</th>
                        <th>Trạng thái</th>
                        <th>Shop</th>
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
    <div class="modal fade" id="DetailModal" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content add-user">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Chi tiết sản phẩm</h1>
                </div>
                <div class="modal-body detail">
                    <div class="left">
                        <img src="http://127.0.0.1:8000/img/ICVVE6033.JPG" id="imgId" />
                        <div class="minileft">
                            <div><img src="../images/galaxys8/Black_1.jpg" onClick="doianh(this)" /></div>
                            <div><img src="../images/galaxys8/Black_2.jpg" onClick="doianh(this)" /></div>
                            <div><img src="../images/galaxys8/Black_3.jpg" onClick="doianh(this)" /></div>
                            <div><img src="../images/galaxys8/Black_4.jpg" onClick="doianh(this)" /></div>
                            <div><img src="../images/galaxys8/Black_5.jpg" onClick="doianh(this)" /></div>
                        </div>
                    </div>
                    <div class="right">
                        <h2 id='name'>Samsung Galaxy S8+</h2>
                        <h2 id='price' class="red">20.050.000 VNĐ</h2>
                        <h3>Màu sắc</h3>
                        <div class="button">
                        </div>
                    </div>
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
                            <input type="text" class="form-control form-control-user" id='addressUp' name="address"
                               >
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
                            <input type='submit' class="btn btn-success btn-user btn-block btSubmitUpdate" value="Lưu"> 
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
                <form method='delete'>
                    @csrf
                <div class="modal-body">Xác nhận xóa người dùng <span id='nameDelete'></span></div>
                <div class="modal-footer">
                    <a class="btn btn-primary btSubmitDelete" >Xác nhận</a>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>                    
                </div>
                </form>
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
                <div class="modal-body">Xác nhận khóa/mở người dùng <span id='nameBlock'></span></div>
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

<script src="{{asset('js/ajax/ajax_product.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

@endsection