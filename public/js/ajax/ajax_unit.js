$(document).ready(function(){   

    fetch_unit();

    function fetch_unit()
    {
        $('#myTable').DataTable({
            'processing':true,
            'serverSide':true,
            'ajax':'/admin/unit/fetch',
            'columns':[
                { 'data': 'unit_id'},
                { 'data': 'unit_name' },
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

    $(document).on('click', '.btSubmitAdd', function(e){
        e.preventDefault();
        $.ajax({
            url:'/admin/unit/add',
            type:'post',
            data: new FormData($('#formadd')[0]),
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
                alert('Lỗi');
            }
        });
    });


    // thông báo xóa 
    $(document).on('click', '.bt-Delete',function(e)
    {
        e.preventDefault();
        var _id = $(this).attr('value');
        $('#DeleteUnit').modal('show');
        $.ajax({
            url : '/admin/unit/getId/' + _id,
            type : 'get',
            success:function(response)
            {
                console.log(response);
                $.each(response.uni, function(key, item){
                    $('#idDelete').val(item.unit_id);
                    $('#unitDelete').html(item.unit_name);
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
        var _id = $('#idDelete').val();
        $.ajax({
            url:'/admin/unit/delete/' +_id,
            type:"get",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response)
            {      
                $(".alert-success").css('display','block');
                $('.alert-success').html(response.mess);
                $('#DeleteUnit').modal('hide');
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
            url : '/admin/unit/getId/'+ _id,
            success: function(response){
                $.each(response.uni, function(key, item){
                    $('#idUp').val(item.unit_id);
                    $('#unitUp').val(item.unit_name);
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
            'unitUp': $('#unitUp').val()
        }
        $.ajax({
            url:'/admin/unit/update/' + id,
            type:"put",
            data: data,
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response)
            {   
                $(".alert-success").css('display','block');
                $('.alert-success').html(response.messages);
                $('#DeleteModal').modal('hide');
                $('#myTable').DataTable().ajax.reload();
                $('.alert-success').hide(5000);
            },
            error: function (err)
            {
                 alert('Lỗi');
            }
        });
    });

});