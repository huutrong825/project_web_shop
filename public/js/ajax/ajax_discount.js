$(document).ready(function(){   

    fetch_discount();

    function fetch_discount()
    {
        $('#myTable').DataTable({
            'processing':true,
            'serverSide':true,
            'ajax':'/admin/discount/fetch',
            'columns':[
                { 'data': 'dis_id', 'visible': false},
                { 'data': 'dis_name' },
                { 'data': 'type_disc' },
                { 'data': 'value' },
                { 'data': 'start_day' },
                { 'data': 'end_day' },
                { 'data': 'is_state' },
                { 'data': 'action','orderable': false, 'searchable': false},
            ],
            'order' : [[0, 'desc']],
            'searching':false,
        });
    }
    //show popup add
    $(document).on('click', '.bt-Add', function(e){
        e.preventDefault();
        $('#AddDiscount').modal('show');
    });

    //validate
    $(document).ready(function(){
        
        $('#formadd').validate({
            'rules' :{
                'namedis':'required',
                'typedis' : 'required',
                'value' : 'required' ,
                'startday' : {
                    'required' : true,
                                   
                },
                'endday':{
                    'required':true
                },
            },
            'messages' :{
                'namedis':'Tên không được trống',
                'typedis': 'Chọn loại khuyến mãi',
                'value' :  'Giá trị không được trống',
                'startday': {
                    'required' : 'Chưa chọn ngày bắt đầu',
                },
                'endday' : 'Chưa chọn ngày kết thúc'
            },
        });
    });
    //thêm discount
    $(document).on('click', '.btSubmitAdd', function(e){
        e.preventDefault();
        $('#formadd').submit();
        $.ajax({
            url : '/admin/discount/add',
            type: 'post',
            data : new FormData($('#formadd')[0]),
            contentType: false,
            processData: false,
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
                $(".alert-success").css('display','block');
                $('.alert-success').html(response.messages);
                $('#AddDiscount').modal('hide');
                $('#myTable').DataTable().ajax.reload();
            },
            error: function(err)
            {
                alert('lõi');
            }
        });
    });

    // hiện popup Update
    $(document).on('click', '.bt-Update',function(e)
    {
        e.preventDefault();
        var id = $(this).attr('value');
        $('#UpdateDis').modal('show');
        $.ajax({
            url:'/admin/discount/getId/' + id,
            type: 'get',
            success: function(response)
            {
                $.each(response.dis, function(key, item){
                    $('#idUp').val(item.dis_id);
                    $('#nameUp').val(item.dis_name);
                    $('#typeOld').val(item.type_disc);
                    $('#valueUp').val(item.value);
                    $('#startdayUp').val(item.start_day);
                    $('#enddayUp').val(item.end_day);

                    // $('#startdayUp').attr('placeholder',item.start_day);
                    // $('#enddayUp').attr('placeholder',item.end_day);
                    typeOld = (item.type_disc == 1) ?'Giảm theo % giá trị' :
                        (item.type_disc == 2 ?'Giảm theo số tiền' : 'Sản phẩm tặng kèm');
                    $('#typeOld').html(typeOld);
                });
            },
            error: function (err)
            {
                alert('Lỗi');
            }
        });
    });
    //update
    $(document).on('click','.btSubmitUpdate',  function(e){
        e.preventDefault();
        var id = $('#idUp').val();
        var data =
        {
            'nameUp' : $('#nameUp').val(),
            'typedisUp': $('#typeOld').val(),
            'valueUp': $('#valueUp').val(),
            'startdayUp': $('#startdayUp').val(),
            'enddayUp': $('#enddayUp').val()
        }
        $.ajax({
            url : '/admin/discount/update/' + id,
            type : "put",
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data : data,
            dataType : 'json',
            success : function(response){
                $('#myTable').DataTable().ajax.reload();
                $(".alert-success").css('display','block');
                $('.alert-success').html(response.messages);
                $('.alert-success').hide(8000);              
            },
            error: function (err) {
                alert('Lỗi');
            }
        });
    });

    // thông báo khóa
    $(document).on('click', '.bt-Block',function(e)
    {
        e.preventDefault();
        var id = $(this).attr('value');
        $('#BlockDis').modal('show');
        $.ajax({
            url : '/admin/discount/getId/'+ id,
            type : 'GET',
            success : function(response)
            {
                $.each(response.dis, function(key, item){
                    $('#idBlock').val(item.dis_id);
                    $('#nameBlock').html(item.dis_name);
                });
            },
            error : function (err)
            {
                alert(err.messages);
            }
        });
    });
    // Xác nhận khóa/mở
    $(document).on('click', '.btSubmitBlock',function(e)
    {
        e.preventDefault();
        var id = $('#idBlock').val();
        console.log(id);
        $.ajax({
            url : '/admin/discount/block/' +id,
            type : 'get',
            success : function(response)
            {      
                console.log(response);
                $(".alert-success").css('display','block');
                $('.alert-success').html(response.messages);
                $('#BlockDis').modal('hide');
                $('#myTable').DataTable().ajax.reload();
                $('.alert-success').hide(5000);
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
            url : '/admin/discount/getId/'+_id,
            type : 'get',
            success : function(response)
            {
                $.each(response.dis, function(key, item){
                    $('#idDelete').val(item.dis_id);
                    $('#nameDelete').html(item.dis_name);
                });
            },
            error : function (err)
            {
                alert('Lỗi');
            }
        });
    });
    // Xác nhận xóa
    $(document).on('click', '.DeleteDis',function(e)
    {
        e.preventDefault();
        var id = $('#idDelete').val();
        $.ajax({
            url : '/admin/discount/delete/' + id,
            type : 'get',
            success : function(response)
            {      
                $(".alert-success").css('display','block');
                $('.alert-success').html(response.messages);
                $('#DeleteModal').modal('hide');
                $('#myTable').DataTable().ajax.reload();
                $('.alert-success').hide(8000);
            },
            error : function (err)
            {
                 alert('Lỗi');
            }
        });
    });

    $(document).on('click', '.btLink',function(e)
    {
        e.preventDefault();
        $('#LinkProduct').modal('show');
    });

    $(document).on('click', '.btSubmitLink',function(e)
    {
        e.preventDefault();
        $.ajax({
            url: '/admin/discount/add-product',
            type : "post",
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data : new FormData($('#form-link')[0]),
            dataType : 'json',
            contentType: false,
            processData: false,
            success : function(response){
                $(".alert-success").css('display','block');
                $('.alert-success').html(response.messages);
                $('#LinkProduct').modal('hide');
                $('.alert-success').hide(5000);
            },
            error: function (err) {
                alert('Lỗi');
            }

        });
    });
});