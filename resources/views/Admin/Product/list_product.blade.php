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
        </div>
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
                        <th>Shop</th>
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
    <div class="modal fade" id="DetailModal" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content add-user">
                <div class="modal-header">
                </div>
                <div class="text-center">
                    <h1 class="h2 text-green mb-4">Chi tiết sản phẩm</h1>
                </div>
                <div class="alert alert-success " style="display:none">
                </div>
                <div class="modal-body detail">
                    <div class="left">
                        <img  id="imgId" alt='picture'/>
                        <div >
                            <form id='uploadImg' method="post" enctype="multipart/form-data">
                                @csrf
                                <a type='submit' class='btn btn-primary Upload' >Upload</a>
                                <input id='imgUp' name='imgUp' type="file" >
                            </form>
                        </div>
                    </div>
                    <div class="right">
                        <div class="form-group ">
                                <div class="">
                                    <input type="hidden" class="form-control form-control-user" id='idUp' name="idUp"
                                        required>
                                </div>
                            <div class="form-group col-sm-12">
                                <label>Tên sản phẩm</label>
                                <div class="">
                                    <input type="text" class="form-control form-control-user" id='nameUp' name="nameUp"
                                        required>
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Giá bán</label>
                                <div class="">
                                    <input type="text" class="form-control form-control-user" id='priceUp' name="priceUp"
                                    required>
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Mô tả</label>
                                <div class="">
                                    <textarea type="text" rows='5' style="resize: none;" class="form-control form-control-user" id='descrip' name="descrip">
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label>Shop cung cấp</label>
                                <select class="form-control " id="suppid" name="suppid" >
                                <option selected id='supp'></option>
                                    @foreach($supplier as $s)
                                    <option value="{{ $s->id }}">{{ $s->id }} {{ $s->supplier_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-primary btSubmitUpload" >Lưu</a>
                                <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>                    
                            </div>
                        </div>
                    </div>
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
    <div class="modal fade" id="BlockPro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <div class="modal-body">Xác nhận khóa/mở người dùng <span id='nameBlock'></span></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btSubmitBlock" >Xác nhận</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>                    
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DropImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content add-user">
                <div class="modal-header">
                </div>
                <div class="text-center">
                    <h1 class="h2 text-green mb-4">Hình ảnh sản phẩm</h1>
                </div>
                <div class="modal-body ">
                    <div id="preview"></div>
                    <div>
                    <input type="hidden" class="form-control form-control-user" id='idDrop' >
                    <form method='post' action="/admin/product/dropImage" class="dropzone" id="DropzoneForm" name="DropzoneForm"enctype="multipart/form-data" >
                        @csrf
                        <input type="hidden" class="form-control form-control-user" id='idDrop' >
                    </form>
                    <button type="button" class="btn btn-primary" id="btDrop">Submit and display data</button>
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

<script src="{{asset('js/ajax/ajax_product.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

@endsection