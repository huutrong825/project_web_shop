
$(document).ready(function(){

    fetch_supplier();
    // Đổ data ra bảng
    function fetch_supplier()
    {
        $('#myTable').DataTable({
            'processing' : true,
            'serverSide' : true,
            'ajax':
            {
                url : '/admin/supplier/fetch',
                data : function (d){
                    d.key = $('#keySearch').val();
                    d.phone = $('#phone').val();
                    d.address = $('#address').val();
                    d.state = $('#state').val();
                }
            },
            'columns':[
                { 'data' : 'id', },
                { 'data' : 'supplier_name' },
                { 'data' : 'address' },
                { 'data' : 'phone' },
                { 'data' : 'is_state' },
                { 'data' : 'action', 'orderable' : false,'searchable' : false},
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
        $('#phone').val('');
        $('#address').val('');
        $('#state').val($('#state option:first').val());
        $('#myTable').DataTable().destroy();
        fetch_supplier();
    });
    // Mở popup thêm
    $(document).on('click', '.bt-Add',function(e)
    {
        e.preventDefault();
        $('#AddModal').modal('show');
    });

    $('#formadd').validate({
        rules :
        {
            'txtname' : 'required',
            'address' : 'required',
            'phone' : 'required'
        },
        messages:
        {
            'txtname' : 'Tên không được trống',
            'address' : 'Địa chỉ không được trống',
            'phone' : 'Số điện thoại khồn được trống'
        }
    });
    // Thêm Supplier

    $(document).on('click', '.btSubmitAdd',function(e)
    {
        e.preventDefault();
        var data =
        {
            'namesupp' : $('#namesupp').val(),
            'addressnew' : $('#addressnew').val(),
            'phonenew' : $('#phonenew').val(),
        };
        $('#formadd').submit();
        $.ajax({
            url : '/admin/supplier/add',
            type : 'post',
            data : data,
            dataType : 'json',
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response)
            {  
                $('#AddUserModal').modal('hide');
                $('#myTable').DataTable().ajax.reload();
            },
            error: function (err)
            {
                alert('Looix');
            }
        });
    });
    // thông báo khóa
    $(document).on('click', '.bt-Block',function(e)
    {
        e.preventDefault();
        var _id = $(this).attr('value');
        $('#BlockModal').modal('show');
        $.ajax({
            url : '/admin/supplier/getId/'+_id,
            type : 'GET',
            success : function(response)
            {
                $.each(response.supp, function(key, item){
                    $('#idBlock').val(item.id);
                    $('#nameBlock').html(item.supplier_name);
                });
            },
            error : function (err)
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
            url : '/admin/supplier/block/' +_id,
            type : 'put',
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success : function(response)
            {      
                alertify.success(response.mess);
                $('#BlockModal').modal('hide');
                $('#myTable').DataTable().ajax.reload();
            },
            error : function (err)
            {
                alert('Lỗi');
            },
        });
    });
    // thông báo xóa 
    $(document).on('click', '.bt-Delete',function(e)
    {
        e.preventDefault();
        var _id = $(this).attr('value');
        $('#DeleteModal').modal('show');
        $.ajax({
            url : '/admin/supplier/getId/'+_id,
            type : 'get',
            success : function(response)
            {
                $.each(response.supp, function(key, item){
                    $('#idDelete').val(item.id);
                    $('#nameDelete').html(item.supplier_name);
                });
            },
            error : function (err)
            {
                alert('Lỗi');
            }
        });
    });
    // Xác nhận xóa
    $(document).on('click', '.DeleteSupp',function(e)
    {
        e.preventDefault();
        var id = $('#idDelete').val();
        console.log(id);
        $.ajax({
            url : '/admin/supplier/delete/' + id,
            type : 'get',
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success : function(response)
            {      
                // $(".alert-success").css('display','block');
                // $('.alert-success').html(response.mess);
                $('#DeleteModal').modal('hide');
                $('#myTable').DataTable().ajax.reload();
                // $('.alert-success').hide(8000);
            },
            error : function (err)
            {
                 alert('Lỗi');
            }
        });
    });
    // popup update
    $(document).on('click', '.bt-Update',function(e)
    {
        e.preventDefault();
        var _id = $(this).attr('value');
        $('#UpdateModal').modal('show');
        $.ajax({
            type :'get',
            url : '/admin/supplier/getId/'+_id,
            success : function(response){
                $.each(response.supp, function(key, item){
                    $('#idUp').val(item.id);
                    $('#nameUp').val(item.supplier_name);
                    $('#addressUp').val(item.address);
                    $('#phoneUp').val(item.phone);
                });
            },
            error : function (err)
            {
                alert('Lỗi');
            }
        });
    });

    $(document).on('click', '.btSubmitUpdate',function(e)
    {
        e.preventDefault();
        var id = $('#idUp').val();
        var data = {
            'nameUp': $('#nameUp').val(),
            'addressUp': $('#addressUp').val(),
            'phoneUp': $('#phoneUp').val()
        }
        console.log(id);
        $.ajax({
            url : '/admin/supplier/update/' +id,
            type : "put",
            data : data,
            dataType : 'json',
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success : function(response)
            {
                $('#myTable').DataTable().ajax.reload();
                alertify.success(response.mess);
            },
            error : function (err)
            {
                alert('Lỗi');
            },
        });
    });

});