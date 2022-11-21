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
                    <a href="" class="btn btn-primary btn-icon-user btAdd" >
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
                </form>                
                <div class=" col-sm">
                        <a class="btn btn-success" type="reset" id='btReset' title="Reset"><i class="fas fa-sync"></i></a>
                    </div>
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

    <!-- <div class="modal fade" id="DropModal" role="dialog" aria-labelledby="exampleModalLabel"
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
                <div class="table-responsive col-sm">
                    <input type="hidden" class="form-control form-control-user" id='idDrop' >
                    <form method='post' class="dropzone" id="DropzoneForm" name="DropzoneForm"enctype="multipart/form-data" >
                        @csrf
                    </form>
                    <br />
                    <br />
                    <div style="align:center" >
                        <a  class="btn btn-primary btn-sm" id="btDrop" title="Click to drop"><i class="fas fa-cloud-upload"></i>Xác nhận</a>
                    </div>
                    <br />
                    <div class="dropzone" id="preview"></div>
                    <br />
                    </div>
                </div>
            </div>
        </div>
    </div> -->

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
                <div class="modal-body">Xác nhận xóa sản phẩm <span id='nameDelete'></span></div>
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
                    <h5 class="modal-title" id="exampleModalLabel">Đổi mật khẩu</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="">
                    <input type="hidden" class="form-control form-control-user" id='idBlock' >
                </div>
                <div class="modal-body">Xác nhận khóa/mở sản phẩm <span id='nameBlock'></span></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btSubmitBlock" >Xác nhận</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>                    
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="AddProd"  role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content add-user">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="text-center">
                    <h1 class="h2 text-green mb-4">Thêm sản phẩm</h1>
                </div>
                <div class="modal-body ">
                    <div class="table-responsive col-sm">
                        <input type="hidden" class="form-control form-control-user" id='idDrop' >
                        <form class="user" id='formadd'  enctype="multipart/form-data">
                            @csrf
                            <fieldset>                    
                                <div class="form-group">
                                    <div class="">
                                        <input type="text" class="form-control form-control-user" id='txtname' name="txtname"
                                            placeholder="Nhập tên sản phẩm" required>
                                    </div>
                                    <p style="color:red" class="help is-danger"></p>
                                </div>
                                <div class="form-group select row">
                                    <div class="col-sm-6">
                                        <select class="form-control select" id="category" name="category" >
                                        <option disabled selected hidden>Chọn loại sản phẩm</option>
                                            @foreach($category as $c)
                                            <option value="{{ $c-> category_id }}">{{ $c-> category_id }} {{ $c->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="form-control select" id="suppl" name="suppl" >
                                        <option disabled selected hidden>Chọn shop</option>
                                            @foreach($supplier as $s)
                                            <option value="{{ $s->id }}">{{ $s->id }} {{ $s->supplier_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 ">
                                        <input type="text" class="form-control form-control-user"
                                            name="quanity" id='quanity' placeholder="Nhập số lượng" required>
                                    </div>
                                    <p style="color:red" class="help is-danger"></p>
                                
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user"
                                            name="price" id='price' placeholder="Nhập đơn giá (VNĐ)" required>
                                    </div>
                                    <p style="color:red" class="help is-danger"></p>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 ">
                                        <select class="form-control select" id="units" name="units" >
                                        <option disabled selected hidden>Chọn đơn vị tính</option>
                                            @foreach($unit as $un)
                                            <option value="{{ $un->unit_id }}">{{ $un->unit_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <input type="file" class="form-control select" name="image">
                                        <p style="color:red" class="help is-danger"></p>
                                    </div>
                                </div>
                                <div>
                                <div class="form-group">
                                    <textarea class="form-control" name='descrip' placeholder="Nhập mô tả"></textarea>
                                </div>                                
                            </fieldset>
                            <div class="form-group">
                                <a class="btn btn-success btn-user btAddProd">Thêm mới</a>
                            </div>
                        </form>
                        
                    </div>                    
                </div>
            </div>
        </div>
    </div>

    <!-- Update Quanity Modal -->
    <div class="modal fade" id="UpQuanity" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content add-user">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Thêm số lượng sản phẩm</h1>
                </div>
                <div class="alert alert-success " style="display:none">
                </div>
                <div class="modal-body">
                    <form class="user" id='formUpdate'>
                    <fieldset>
                        <div class="form-group">
                         <lable>Sản phẩm</lable>
                            <div class="">
                                <input type="hidden" class="form-control form-control-user" id='idUp' >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="">
                                <input type="text" class="form-control form-control-user" id='nameProd' name="nameProd" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <lable>Số lượng trong kho</lable>
                            <div class="">
                                <input type="text" class="form-control form-control-user" id='quani' name="quani" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                        <lable>Số lượng thêm</lable>
                            <div class="">
                                <input type="text" class="form-control form-control-user" id='quaniAdd' name="quaniAdd">
                            </div>
                        </div>
                        <div class="form-group">
                            <a  class="btn btn-success btn-user btn-block btUpdateQua">Cập nhật</a> 
                        </div>
                    </fieldset>
                    </form>
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
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>

<script src="{{asset('js/ajax/drop_images.js')}}" >

@endsection