$(document).ready(function(){   

    fetch_category();

    function fetch_category()
    {
        $('#myTable').DataTable({
            'processing':true,
            'serverSide':true,
            'ajax':'/admin/category/fetch',
            'columns':[
                { 'data': 'category_id'},
                { 'data': 'category_name' },
                { 'data': 'action','orderable': false, 'searchable': false},
            ],
            'order' : [[0, 'desc']],
            'searching':false,
        });
    }

    $(document).on('click','.btAdd', function(e){
        e.preventDefault();
        $('#AddModal').modal('show');
    });

    $(document).ready(function(){
        $('#categoryForm').validate({
            'rules' :{
                'cate_name':'required',
            },
            'messages' :{
                'cate_name':'Tên loại hàng không được trống',
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });

    $(document).on('click', '.btSubmitAdd', function(e){
        e.preventDefault();
        $('#categoryForm').submit();
        $.ajax({
            url:'/admin/category/add',
            type:'post',
            data: new FormData($('#categoryForm')[0]),
            contentType: false,
            processData: false,
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response)
            {
                $('#AddModal').modal('hide');
                $('#myTable').DataTable().ajax.reload();
                $('.alert-success').hide(8000);
            },
            error: function (err)
            {
            //     alert('Lỗi');
            }
        });
    });


    // thông báo xóa 
    $(document).on('click', '.bt-Delete',function(e)
    {
        e.preventDefault();
        var id=$(this).attr('value');
        $('#DeleteModal').modal('show');
        $.ajax({
            url : '/admin/category/getId/'+id,
            type : 'get',
            success:function(response)
            {
                console.log(response);
                $.each(response.cate, function(key, item){
                    $('#idDel').val(item.category_id);
                    $('#nameDel').html(item.category_name);
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
        var _id=$('#idDel').val();
        $.ajax({
            url:'/admin/category/delete/' +_id,
            type:"delete",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response)
            {      
                $(".alert-success").css('display','block');
                $('.alert-success').html(response.mess);
                $('#DeleteModal').modal('hide');
                $('#myTable').DataTable().ajax.reload();
                $('.alert-success').hide(8000);
            },
            error: function (err)
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
            type : 'get',
            url : '/admin/category/getId/'+_id,
            success: function(response){
                $.each(response.cate, function(key, item){
                    $('#idUp').val(item.category_id);
                    $('#cate_nameUp').val(item.category_name);
                });
            },
            error: function (err)
            {
                alert('Lỗi');
            }
        });
    });
    // Update
    $(document).on('click', '.btSubmitUpdate',function(e)
    {
        e.preventDefault();
        var id = $('#idUp').val();
        var data = 
        {
            'cate_nameUp': $('#cate_nameUp').val()
        }
        $.ajax({
            url:'/admin/category/update/' + id,
            type:"put",
            data: data,
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response)
            {   
                $(".alert-success").css('display','block');
                $('.alert-success').html(response.message);
                $('#DeleteModal').modal('hide');
                $('#myTable').DataTable().ajax.reload();
                $('.alert-success').hide(8000);
            },
            error: function (err)
            {
                 alert('Lỗi');
            }
        });
    });

});