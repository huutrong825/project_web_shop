@extends('layout_admin')
@section('css')
    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection
@section('content')

<div class="text-center">
<h1 class="h4 text-gray-900 mb-4">Thêm sản phẩm mới</h1>
</div>
<div class="modal-body">
<form class="user" id='formadd' method="post">
    <fieldset>
        @csrf                      
        <div class="form-group">
            <div class="">
                <input type="text" class="form-control form-control-user" id='txtname' name="txtname"
                    placeholder="Nhập tên sản phẩm" required>
            </div>
            <p style="color:red" class="help is-danger"></p>
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <select class="form-control " id="role" name="category" >
                <option disabled selected hidden>Chọn loại sản phẩm</option>
                    @foreach($category as $c)
                    <option value="{{ $c-> category_id }}">{{ $c-> category_id }} {{ $c->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6">
                <select class="form-control " id="role" name="category" >
                <option disabled selected hidden>Chọn shop</option>
                    @foreach($supplier as $s)
                    <option value="{{ $s->id }}">{{ $s->id }} {{ $s->supplier_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <input type="text" class="form-control form-control-user"
                    name="quanity" id='phone' placeholder="Nhập số lượng" required>
            </div>
            <p style="color:red" class="help is-danger"></p>
        
            <div class="col-sm-6">
                <input type="text" class="form-control form-control-user"
                    name="phone" id='phone' placeholder="Nhập đơn giá (VNĐ)" required>
            </div>
            <p style="color:red" class="help is-danger"></p>
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <select class="form-control" id="role" name="category" >
                <option disabled selected hidden>Chọn đơn vị tính</option>
                    @foreach($unit as $u)
                    <option value="{{ $u->id }}">{{ $u->unit }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-6">
                <input type="file" class="form-control" name="image">
                <p style="color:red" class="help is-danger"></p>
            </div>
        </div>
        <div>
        <div class="form-group">
            <textarea class="form-control" placeholder="Nhập mô tả"></textarea>
        </div>
        
        <div class="form-group">
            <input type='submit' class="btn btn-success btn-user btSubmitAdd" value="Thêm mới"> 
        </div>
    </fieldset>
</form>
@endsection

@section('script')

<!-- Page level plugins -->
<script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}"></script>

<script src="{{asset('js/ajax/ajax_product.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

@endsection