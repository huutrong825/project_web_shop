
$(document).ready(function(){

    fetch_user();

    function fetch_user()
    {
        $('#myTable').DataTable({
            'processing':true,
            'serverSide':true,
            'ajax':
            {
                url : '/admin/user/fetch',
                data : function (d){
                    d.key = $('#keySearch').val();
                    d.group = $('#group').val();
                    d.active = $('#active').val();
                }
            },
            
            'columns':[
                { 'data': 'id','visible':false},
                { 'data': 'name' },
                { 'data': 'email' },
                { 'data': 'group_role' },
                { 'data': 'is_active' },
                { 'data': 'action','orderable': false, 'searchable': false},
            ]
        });
        $('#formSearch').on('keyup submit' ,function(e) {
            $('#myTable').DataTable().search($('#keySearch').val(),$('#group').val(),$('#state').val()).draw();
            e.preventDefault();
        });
    }
    //Reset tìm kiếm
    $(document).on('click','#btReset' ,function() {
        $("#group").val($("#group option:first").val());
        $("#active").val($("#active option:first").val());
        $('#myTable').DataTable().destroy();
        fetch_user();
    });

    // hiện popup Update
    $(document).on('click', '.bt-Update',function(e)
    {
        e.preventDefault();
        var _id=$(this).attr('value');
        $('#UpdateUserModal').modal('show');
        var typeRole='';        
        $.ajax({
            url:'/admin/user/update/' +_id,
            type:"GET",
            success:function(response)
            {
                $('#ID').val(response.user.id);
                $('#nameUpdate').val(response.user.name);
                $('#emailUpdate').val(response.user.email);
                $('#txtrole').val(response.user.group_role);
                
                if(response.user.group_role==1)
                {
                    typeRole='Admin';
                }
                else{
                    typeRole='Employee';
                }
                $('#txtrole').html(typeRole);

            },
            error: function (err)
            {
                alert('Lỗi');
            }
        });
    });

    $(document).on('click','#customCheck', function(){
        $("#pass1").toggle();
        $("#pass2").toggle();
        $("#pass3").toggle();
    });

    // đưa data userupdate đến xử lý
    $(document).on('click','#submitUpdate',  function(e){
        e.preventDefault();
        var id_update = $('#ID').val();
        if ($('#customCheck').is(':checked'))
        {
            var data={
                'names' : $('#nameUpdate').val(),
                'emails' : $('#emailUpdate').val(),
                'group_roles' : $('#role').val(),
                'checks' : $('#customCheck').prop('checked'),
                'password' : $('#oldpass').val(),
                'newpass' : $('#newpass').val(),
                'renewpass' : $('#renewpass').val(),            
            }
        }
        else
        {
            var data={
                'names' : $('#nameUpdate').val(),
                'emails' : $('#emailUpdate').val(),
                'group_roles' : $('#role').val(),
                'checks' : $('#customCheck').prop('checked'),           
            }
        }
        $.ajax({
            url : '/admin/user/update/' + id_update,
            type : "put",
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data : data,
            dataType : 'json',
            success : function(response){
                if(response.status == 412)
                {
                    $(".print-error-up").css('display','block');
                    $('#error_up').html('');
                    $.each(response.errors, function(keys, err_values){
                        $('#error_up').append('<li>'+err_values+'</i>');
                    });
                }
                else
                {
                    $('#UpdateUserModal').modal('hide');
                    $('#myTable').DataTable().ajax.reload();
                }                
            },
            error: function (err) {
                alert('Lỗi');
            }
        });
    });


    $(document).on('click','.btAddUser', function(e){
        e.preventDefault();
        $('#AddUserModal').modal('show');
    });

    $(document).ready(function(){
        $('#formadduser').validate({
            'rules' :{
                'txtname':'required',
                'email' : 'required',
                'password' : {
                    'required' : true,
                    'minlength' : 6,
                },
                'repass' : {
                    'required' : true,
                    'equalTo' : '#password',
                },
                'group_role':'required'
            },
            'messages' :{
                'txtname':'Tên không được trống',
                'email': 'Email khong được trống',
                'password' : {
                    'required' : 'Mật khẩu không được trống',
                    'minlength' : 'Không nhỏ hơn 6 ký tự'
                },
                'repass': {
                    'required' : 'Mật khẩu không được trống',
                   'equalTo' : 'Mật khẩu nhập lại không đúng'
                },
                'group_role' : 'Chưa chọn nhóm người dùng'
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
 
    // thêm use bằng ajax
    $(document).on('click','#btSubmitAdd',function(e){
        e.preventDefault();
        var data={
            'name' : $('#addtxtname').val(),
            'email' : $('#addemail').val(),
            'password' : $('#addpassword').val(),
            'repass' : $('#addrepass').val(),
            'group_role' : $('#addgroup_role').val(),
            'active' : $('#addactive').prop('checked'),            
        }   
            $('#formadduser').submit();
            $.ajax({
                url : '/admin/user/add',
                type : "post",
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : data,
                dataType : 'json',
                success:function(response){   
                    
                    $('#AddUserModal').modal('hide');
                    $('#myTable').DataTable().ajax.reload();
                    
                }
            }); 
    });
    //Alert Delete
   
    $(document).on('click','.bt-Delete',function(e)
    {
        e.preventDefault();
        var _id=$(this).attr('value');
        $('#DeleteModal').modal('show');
        $.ajax({
            url:'/admin/user/getUserDelete/' +_id,
            type:"GET",
            success:function(response)
            {
                $('#idDelete').val(response.user.id);
                $('#nameDelete').html(response.user.name); 
            },
            error: function (err)
            {
                alert('Lỗi');
            }
        });
    });

    // Xác nhận xóa
  
    $(document).on('click','.btDSubmitDelete', function(e)
    {
        e.preventDefault();
        var _id=$('#idDelete').val();
        console.log(_id);
        $.ajax({
            url:'/admin/user/delete/' +_id,
            type:"GET",
            success:function(response)
            {
                $('#DeleteModal').modal('hide');
                $('#myTable').DataTable().ajax.reload();
            },
            error: function (err)
            {
                alert('Lỗi');
            }
        });
    });


    //Alert Block
  
    $(document).on('click','.bt-Block', function(e)
    {
        e.preventDefault();
        var _id=$(this).attr('value');
        $('#BlockModal').modal('show');
        $.ajax({
            url:'/admin/user/getUserBlock/' +_id,
            type:"GET",
            success:function(response)
            {
                $('#idBlock').val(response.user.id);
                $('#nameBlock').html(response.user.name); 
            },
            error: function (err)
            {
                alert('Lỗi');
            }
        });
    });

    // Xác nhận block/open
 
    $(document).on('click','.btDSubmitBlock',function(e)
    {
        e.preventDefault();
        var _id=$('#idBlock').val();
        console.log(_id);
        $.ajax({
            url:'/admin/user/block/' +_id,
            type:"GET",
            success:function(response)
            {               
                $(".alert-success").css('display','block');
                $('.alert-success').html(response.mess);
                $('#BlockModal').modal('hide');
                $('#myTable').DataTable().ajax.reload();
            },
            error: function (err)
            {
                alert('Lỗi');
            }
        });
    });

});

