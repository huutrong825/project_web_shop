
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
                {'data' : 'is_sale'},
                {'data' : 'supplier_name'},
                {'data' : 'action', 'orderable' : false, 'searchable' : false}
            ]
        });
        $('#formSearch').on('keyup click' ,function(e) {
            $('#myTable').DataTable().draw();
            e.preventDefault();
        });
    }

    // thông báo khóa
    $(document).on('click', '.bt-Block',function(e)
    {
        e.preventDefault();
        var _id=$(this).attr('value');
        $('#BlockModal').modal('show');
        $.ajax({
            url:'/admin/supplier/block/'+_id,
            type:"GET",
            success:function(response)
            {
                $.each(response.supp, function(key, item){
                    $('#idBlock').val(item.id);
                    $('#nameBlock').html(item.supplier_name);
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
        var _id=$('#idBlock').val();
        $.ajax({
            url:'/admin/supplier/block/' +_id,
            type:"put",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response)
            {      
                $(".alert-success").css('display','block');
                $('.alert-success').html(response.mess);
                $('#BlockModal').modal('hide');
                $('#dataTable').empty();
                fetch_supplier();
            },
            error: function (err)
            {
                // alert('Lỗi');
            }
        });
    });
    // thông báo xóa 
    $(document).on('click', '.bt-Delete',function(e)
    {
        e.preventDefault();
        var _id=$(this).attr('value');
        $('#DeleteModal').modal('show');
        $.ajax({
            url:'/admin/supplier/delete/'+_id,
            type:"GET",
            success:function(response)
            {
                $.each(response.supp, function(key, item){
                    $('#idDelete').val(item.id);
                    $('#nameDelete').html(item.supplier_name);
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
        var _id=$('#idDelete').val();
        $.ajax({
            url:'/admin/supplier/delete/' +_id,
            type:"delete",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response)
            {      
                $(".alert-success").css('display','block');
                $('.alert-success').html(response.mess);
                $('#DeleteModal').modal('hide');
                $('#dataTable').empty();
                fetch_supplier();
            },
            error: function (err)
            {
                // alert('Lỗi');
            }
        });
    });
    // popup update
    $(document).on('click', '.bt-Update',function(e)
    {
        e.preventDefault();
        var _id=$(this).attr('value');
        $('#UpdateModal').modal('show');
        $.ajax({
            type:'get',
            url:'/admin/supplier/update/'+_id,
            success: function(response){
                $.each(response.supp, function(key, item){
                    $('#idUp').val(item.id);
                    $('#nameUp').val(item.supplier_name);
                    $('#addressUp').val(item.address);
                    $('#phoneUp').val(item.phone);
                });
            },
            error: function (err)
            {
                alert('Lỗi');
            }
        });
    });

    $(document).on('click', '.btSubmitUpdate',function(e)
    {
        e.preventDefault();
        var id=$('#idUp').val();
        var data={
            'nameUp':$('#nameUp').val(),
            'addressUp':$('#addressUp').val(),
            'phoneUp':$('#phoneUp').val()
        }
        console.log(id);
        $.ajax({
            url:'/admin/supplier/update/' +id,
            type:"put",
            data:data,
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response)
            {      
                $(".alert-success").css('display','block');
                $('.alert-success').html(response.mess);
                $('#UpdateModal').modal('hide');
                $('#dataTable').empty();
                fetch_supplier();
            },
            error: function (err)
            {
                 alert('Lỗi');
            }
        });
    });
    //Detail
    $(document).on('click', '.btDetail',function(e)
    {
        e.preventDefault();
        var _id=$(this).attr('value');
        $('#DetailModal').modal('show');
        console.log(_id);
        $.ajax({
            type : 'get',
            url : '/admin/product/detail/' + _id,
            success : function(response){
                console.log(response);
                $.each(response.pro, function(key, item){
                    $('#name').html(item.product_name);
                    $('#price').html(item.unit_price);
                });
            },
            error: function(err)
            {
                alert('Lỗi');
            }
        });
        
    });
});