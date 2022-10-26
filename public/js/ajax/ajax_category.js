$(document).ready(function(){   

    fetch_supplier();

    function fetch_supplier()
    {
        $('#myTable').DataTable({
            'processing':true,
            'serverSide':true,
            'ajax':'/admin/category/fetch',
            'columns':[
                { 'data': 'category_id','visible':false},
                { 'data': 'category_name' },
                { 'data': 'image' },
                { 'data': 'action','orderable': false, 'searchable': false},
            ]
        });
    }

    $(document).on('click','.btAdd', function(e){
        e.preventDefault();
        $('#AddModal').modal('show');
    });

    $(document).on('click','.btSubmitAdd', function(e){
        e.preventDefault();
        var data={
            'cate_name':$('#txtname').val(),
            'file':$('#file').val(),
        }
        
        $.ajax({
            url:'',
            type:'post',
            data:data,
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response)
            {
                console.log(response);
                $('#AddModal').modal('hide');
                $('#AddModal').reset();
                $('#myTable').empty();
                fetch_supplier();
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
            url:'/admin/category/delete/'+id,
            type:"GET",
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
                
            },
            error: function (err)
            {
                alert('Lỗi');
            }
        });
    });
    // // popup update
    // $(document).on('click', '.bt-Update',function(e)
    // {
    //     e.preventDefault();
    //     var _id=$(this).attr('value');
    //     $('#UpdateModal').modal('show');
    //     console.log(_id);
    //     $.ajax({
    //         type:'get',
    //         url:'/admin/supplier/update/'+_id,
    //         success: function(response){
    //             $.each(response.supp, function(key, item){
    //                 $('#idUp').val(item.id);
    //                 $('#nameUp').val(item.supplier_name);
    //                 $('#addressUp').val(item.address);
    //                 $('#phoneUp').val(item.phone);
    //             });
    //         },
    //         error: function (err)
    //         {
    //             alert('Lỗi');
    //         }
    //     });
    // });

    // $(document).on('click', '.btSubmitUpdate',function(e)
    // {
    //     e.preventDefault();
    //     var id=$('#idUp').val();
    //     var data={
    //         'nameUp':$('#nameUp').val(),
    //         'addressUp':$('#addressUp').val(),
    //         'phoneUp':$('#phoneUp').val()
    //     }
    //     console.log(id);
    //     $.ajax({
    //         url:'/admin/supplier/update/' +id,
    //         type:"put",
    //         data:data,
    //         dataType:'json',
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         success:function(response)
    //         {      
    //             $(".alert-success").css('display','block');
    //             $('.alert-success').html(response.mess);
    //             $('#UpdateModal').modal('hide');
    //             $('#dataTable').empty();
    //             fetch_supplier();
    //         },
    //         error: function (err)
    //         {
    //              alert('Lỗi');
    //         }
    //     });
    // });

});