
$(document).ready(function(){

    fetch_supplier();
    // Đổ data ra bảng
    function fetch_supplier()
    {
        $('#dataTable').DataTable({
            processing:true,
            serveSide:true,
            ajax:"{{asset('/admin/supplier/fetch')}}",
            columns:[
                { data: 'id', name: 'id' },
                { data: 'supplier_name', name: 'supplier_name' },
                { data: 'address', name: 'address' },
                { data: 'phone', name: 'phone' },
                { data: 'is_state', name: 'is_state' },
            ]
        });
        $.ajax({
            type:'get',
            url:'/admin/supplier/fetch',
            dataType:'json',
            success:function(response){
                $.each(response.supp, function(key, item){
                    var text='';
                    switch(item.is_state){
                        case 0:
                            text='<td style="color:red ">Ngừng cung ứng</td>'
                            break;
                        case 1:
                            text='<td style="color:green">Đang cung ứng</td>'
                            break;
                        default:
                            text='<td>Errol</td>'
                    }               
                    $('#dataTable').append(
                        '<tr>\
                        <td  style="display:none">' + item.id +'</td>\
                        <td>'+ item.supplier_name +'</td>\
                        <td>'+ item.address+'</td>\
                        <td>'+ item.phone +'</td>\
                        '+text+'\
                        <td><a value="'+ item.id+ '" class="btn btn-success btn-circle btn-sm bt-Update">\
                                <i class="fas fa-pen"></i>\
                            </a>\
                            <a value=" '+ item.id +'" class="btn btn-danger btn-circle btn-sm bt-Delete" >\
                                <i class="fas fa-trash"></i>\
                            </a>\
                            <a value=" '+ item.id+'" class="btn btn-warning btn-circle btn-sm bt-Block">\
                                <i class="fas fa-user-times"></i>\
                            </a>\
                        </td>\
                        </tr>'
                    );
                });
            }
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
            url:'/admin/supplier/getIdBlock/'+_id,
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
            url:'/admin/supplier/getIdDelete/'+_id,
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
    // Xác nhận block/open
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


});