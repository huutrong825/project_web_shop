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
        $('#formSearch').on('keyup change' ,function(e) {
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

    fetch_add_store();
    function fetch_add_store()
    {  
        $('#store_pro').DataTable({
            'processing':true,
            'serverSide':true,
            'ajax':
            {
                url : '/admin/product/store',
                data : function (d){
                    d.key = $('#keySearch').val();
                    d.pricefrom = $('#price_from').val();
                    d.priceto = $('#price_to').val();
                    d.fromday = $('#from-day').val();
                    d.today = $('#to-day').val();
                }
            },
            'columns':[
                {'data' : 'pro_id','visible':false},
                {'data' : 'product_name'},
                {'data' : 'quanity_add'},
                {'data' : 'price'},          
                {'data' : 'date_add'},
            ],
            'order' : [[4, 'desc']],
            'searching':false,
        });
        $('#formSearch').on('keyup change' ,function(e) {
            $('#store_pro').DataTable().draw();
            e.preventDefault();
        });
    }

    // reset
    $(document).on('click','#btReset' ,function() {
        $('#keySearch').val('');
        $('#price_from').val('');
        $('#price_to').val('');
        $('#from-day').val('');
        $('#to-day').val('');
        $('#store_pro').DataTable().destroy();
        fetch_add_store();
    });

    $(document).on('click', '.btAdd',function(e)
    {
        e.preventDefault();
        $('#AddProd').modal('show');
    });

    $('#formadd').validate({
        rules :
        {
            'txtname' : 'required',
            'category' : 'required',
            'suppl' : 'required',
            'quanity' : {
                'required': true,
                'number' : true
            },
            'price' : {
                'required': true,
                'number': true
            },
            'units' : 'required',
            'image' : {
                'required': true,
                'extension' : "jpg|jpeg|png|ico|bmp",
            }
        },
        messages:
        {
            'txtname' : 'Nhập tên sản phẩm',
            'category' : 'Chọn loại hàng',
            'suppl' : 'Chọn nhà cung ứng',
            'quanity' : {
                'required' : 'Nhập số lượng',
                'number' : 'Ký tự không phù hợp'
              },
            'price' : {
                'required' : 'Nhập giá sản phẩm',
                'number' : 'Ký tự không phù hợp'
              },
            'units' : 'Chọn đơn vị',
            'image' : {
                'required': 'Chọn ảnh',
                'extension' : 'File không phù hợp'
            }
            
        }
    });
    // thêm product
    $(document).on('click', '.btAddProd',function(e) {
        e.preventDefault();
        $('#formadd').submit();
        $.ajax({
            url : '/admin/product/add',
            type : 'post',
            data : new FormData($('#formadd')[0]),
            contentType: false,
            processData: false,
            dataType : 'json',
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response)
            {  
                alertify.success(response.messages);
                $('#myTable').DataTable().ajax.reload();
            },
            error: function (err)
            {
                alert('lỗi');
            }
        });
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
                alertify.success(response.messages);
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
                alertify.success(response.messages);
                $('#DeleteModal').modal('hide');
                $('#myTable').DataTable().ajax.reload();
            },
            error: function (err)
            {
                // alert('Lỗi');
            }
        });
    });
    //validate
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
                alertify.success(response.messages);
            },
            error: function (err)
            {
                 alert('Lỗi');
            }
        });
    });
    //upload ảnh trong product
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

    $(document).on('click', '.btAddQua',function(e)
    {
        e.preventDefault();
        var _id = $(this).attr('value');
        $('#UpQuanity').modal('show');
        $.ajax({
            type : 'get',
            url : '/admin/product/getId/' + _id,
            success : function(response){
                $.each(response.pro, function(key, item){
                    $('#idUp').val(item.product_id)
                    $('#nameProd').val(item.product_name);
                    $('#quani').val(item.quanity);
                });
            },
            error: function(err)
            {
                alert('Lỗi');
            }
        });
        
    });

    $(document).on('click', '.btUpdateQua',function(e)
    {
        e.preventDefault();
        var id = $('#idUp').val();
        var data = {
            'quanityAdd' : $('#quaniAdd').val()
        }
        $.ajax({
            url:'/admin/product/updateQuanity/' + id,
            type:"put",
            data: data,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response)
            {      
                alertify.success(response.messages);
                $('#UpQuanity').modal('hide');
                $('#myTable').DataTable().ajax.reload();
            },
            error: function (err)
            {
                 alert('Lỗi');
            }
        });
    });

    $(document).on('click','#storeExcel',function(e){
        e.preventDefault();

        var key = $('#keySearch').val();
        var pricefrom = $('#price_from').val();
        var priceto = $('#price_to').val();
        var fromday = $('#from-day').val();
        var today = $('#to-day').val();

        var data;

        if (key != '' || pricefrom != '' || priceto != '' || fromday != '' || today !='') {
           data = {
                key : key,
                pricefrom : pricefrom,
                priceto : priceto,
                fromday : fromday,
                today : today
            }
        }

        window.location = '/admin/product/export?' + $.param(data);
        
    });
    
});
