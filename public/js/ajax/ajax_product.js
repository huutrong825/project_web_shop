$(document).ready(function(){

    fetch_product();
    // Đổ data ra bảng
    function fetch_product()
    {  
        $('#myTable').DataTable({
            'processing':true,
            'serverSide':true,
            'ajax':
            {
                url : '/admin/product/fetch',
                data : function (d){
                    d.key = $('#keySearch').val();
                    d.pricefrom = $('#price_from').val();
                    d.priceto = $('#price_to').val();
                    d.state = $('#state').val();
                }
            },
            'columns':[
                {'data' : 'product_id','visible':false},
                {'data' : 'product_name'},
                {'data' : 'unit_price'},
                {'data' : 'image'},
                {'data' : 'supplier_name'},
                {'data' : 'is_sale'},
                {'data' : 'action', 'orderable' : false, 'searchable' : false}
            ],
            'order' : [[0, 'desc']],
            'searching':false,
        });
        $('#formSearch').on('keyup click' ,function(e) {
            $('#myTable').DataTable().draw();
            e.preventDefault();
        });
    }
    // reset
    $(document).on('click','#btReset' ,function() {
        $('#keySearch').val('');
        $('#price_from').val('');
        $('#price_to').val('');
        $('#state').val($('#state option:first').val());
        $('#myTable').DataTable().destroy();
        fetch_product();
    });

    // thông báo khóa
    $(document).on('click', '.btBlock',function(e)
    {
        e.preventDefault();
        var id = $(this).attr('value');
        $('#BlockPro').modal('show');
        $.ajax({
            url:'/admin/product/getId/'+ id,
            type: 'get',
            success:function(response)
            {
                $.each(response.pro, function(key, item){
                    $('#idBlock').val(item.product_id);
                    $('#nameBlock').html(item.product_name);
                });
            },
            error: function (err)
            {
                alert('Lỗi');
            }
        });
    });
    // Xác nhận khóa/mở
    $(document).on('click', '.btSubmitBlock',function(e)
    {
        e.preventDefault();
        var _id = $('#idBlock').val();
        $.ajax({
            url:'/admin/product/block/' +_id,
            type: 'get',
            success:function(response)
            {      
                $(".alert-success").css('display','block');
                $('.alert-success').html(response.messages);
                $('#BlockPro').modal('hide');
                $('#myTable').DataTable().ajax.reload();
            },
            error: function (err)
            {
                // alert('Lỗi');
            }
        });
    });
    // thông báo xóa 
    $(document).on('click', '.btDelete',function(e)
    {
        e.preventDefault();
        var _id = $(this).attr('value');
        $('#DeleteModal').modal('show');
        $.ajax({
            url:'/admin/product/getId/' + _id,
            type:"GET",
            success:function(response)
            {
                $.each(response.pro, function(key, item){
                    $('#idDelete').val(item.product_id);
                    $('#nameDelete').html(item.product_name);
                });
            },
            error: function (err)
            {
                alert('Lỗi');
            }
        });
    });
    // Xác nhận xóa
    $(document).on('click', '.btSubmitDelete',function(e)
    {
        e.preventDefault();
        var id = $('#idDelete').val();
        $.ajax({
            url: '/admin/product/delete/' + id,
            type: 'get',
            success:function(response)
            {      
                $(".alert-success").css('display','block');
                $('.alert-success').html(response.messages);
                $('#DeleteModal').modal('hide');
                $('.alert-success').hide(3000);
                $('#myTable').DataTable().ajax.reload();
            },
            error: function (err)
            {
                // alert('Lỗi');
            }
        });
    });
    $(document).ready(function(){
        $('#formUpdate').validate({
            'rules' :{
                'nameUp':'required',
                'price' : {
                    'required' : true,
                    'digits' : true,
                    'min' : 1
                },
            },
            'messages' :{
                'nameUp' : {
                    'required' : 'Nhập mật khẩu mới',
                    'minlength' : 'Không nhỏ hơn 6 ký tự'
                },
                'renewpass': {
                    'required' : 'Xác nhận lại mật khẩu',
                   'equalTo' : 'Mật khẩu nhập lại không đúng'
                }
            }
        });
    });
    //Detail
    $(document).on('click', '.btDetail',function(e)
    {
        e.preventDefault();
        var _id = $(this).attr('value');
        $('#DetailModal').modal('show');
        $.ajax({
            type : 'get',
            url : '/admin/product/getId/' + _id,
            success : function(response){
                $.each(response.pro, function(key, item){
                    $('#idUp').val(item.product_id)
                    $('#nameUp').val(item.product_name);
                    $('#priceUp').val(item.unit_price);
                    $('#descrip').val(item.description);
                    $('#supp').val(item.supplier_id);
                    $('#supp').html(item.supplier_name);
                    $url = 'http://127.0.0.1:8000/img/' + item.image ;
                    $('#imgId').attr('src',$url);
                });
            },
            error: function(err)
            {
                alert('Lỗi');
            }
        });
        
    });

    $(document).on('click', '.btSubmitUpload',function(e)
    {
        e.preventDefault();
        var id = $('#idUp').val();
        var data = {
            'nameUp' :  $('#nameUp').val(),
            'priceUp' :  $('#priceUp').val(),
            'descrip' :  $('#descrip').val(),
            'supp':  $('#suppid').val(),
        }
        $.ajax({
            url:'/admin/product/update/' + id,
            type:"put",
            data: data,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response)
            {      
                $(".alert-success").css('display','block');
                $('.alert-success').html(response.messages);
                $('.alert-success').hide(3000);
            },
            error: function (err)
            {
                 alert('Lỗi');
            }
        });
    });

    $(document).on('click', '.Upload',function(e)
    {
        e.preventDefault();
        var id = $('#idUp').val();
        $.ajax({
            url:'/admin/product/loadImg/' + id,
            type:'post',
            data: new FormData($('#uploadImg')[0]),
            contentType: false,
            processData: false,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'contentType': 'multipart/form-data',
            },
            success: function(response)
            {
                $url = 'http://127.0.0.1:8000/img/' + response.image ;
                $('#imgId').attr('src',$url);
                $('#myTable').DataTable().ajax.reload();
            },
            error: function (err)
            {
            }
        });
    });

    $(document).on('click', '.btDropImg', function(e){
        e.preventDefault();
        var id = $(this).attr('value');
        $('#DropImage').modal('show');
        
    });
});