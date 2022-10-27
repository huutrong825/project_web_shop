
$(document).ready(function(){

    fetch_product();
    // Đổ data ra bảng
    function fetch_product()
    {  
        $('#myTable').DataTable({
            'processing':true,
            'serverSide':true,
            'ajax':'/admin/product/fetch',
            'columns':[
                {'data':'product_id','visible':false},
                {'data':'product_name'},
                {'data':'unit_price'},
                {'data':'image'},
                {'data':'is_sale'},
                {'data':'supplier_name'},
                {'data':'action','orderable':false,'searchable':false}
            ]
            
        });
    }

    // Mở popup thêm
    $(document).on('click', '.bt-Add',function(e)
    {
        e.preventDefault();
        $('#AddModal').modal('show');
    });

    $('#formadd').validate({
        rules:{
            'txtname':'required',
            'address':'required',
            'phone':'required'
        },
        messages:{
            'txtname.required':'không dc trống'
        }
    });
    // Thêm Supplier
    $('#formadd').submit(function(){

        $(document).on('click', '.btSubmitAdd',function(e)
        {
            e.preventDefault();
            var data={
                'name_sup':$('#txtname').val(),
                'address':$('#address').val(),
                'phone':$('#phone').val(),
                'is_state':$('#state').prop('checked'),
            };
            $.ajax({
                url:'/admin/supplier/add/',
                type:"post",
                data:data,
                dataType:'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(response)
                {   console.log(response);
                    $('#AddModal').modal('hide');
                    $('#AddModal').reset();
                    $('#dataTable').empty();
                    fetch_supplier();
                },
                error: function (err)
                {
                    $('#formadd').validate().messages;
                }
            });
        });

    });
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
        console.log(_id);
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
});