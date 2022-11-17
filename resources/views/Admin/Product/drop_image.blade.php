@extends('layout_admin')
@section('css')
    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection
@section('content')

<div class="alert alert-success" style="display:none">
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Hình ảnh sản phẩm : {{ $pro->product_name }} </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive col-sm">
            <input type="hidden" class="form-control form-control-user" id='idDrop' value="{{ $pro->product_id }}">
            <form method='post' action="/admin/product/dropImage/{{ $pro->product_id }}" class="dropzone" id="DropzoneForm" name="DropzoneForm"enctype="multipart/form-data" >
                @csrf
            </form>
            <br />
            <br />
            
            <br />
            <lable>Ảnh load</lable>
            <div class="dropzone" id="preview"></div>
            <br />
        </div>
            <a  class="btn btn-primary btn-sm" id="btDrop" title="Click to drop"><i class="fas fa-cloud-upload"></i>Xác nhận</a>
            <a href='/admin/product' class="btn btn-danger btn-sm"  title="Click to back"><i class="fas fa-cloud-upload"></i>Trở lại</a>
    </div>
    
</div>

@endsection

@section('script')

<!-- Page level plugins -->
<script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>

<script src="{{asset('js/ajax/drop_images.js')}}" >
</script>
@endsection