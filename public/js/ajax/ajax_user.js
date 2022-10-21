// hiện popup Update
$(document).ready(function(){    
    $(".btUpdate").click(function(e)
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
});

$(document).ready(function (){
    $("#customCheck").click(function(){
        $("#pass1").toggle();
        $("#pass2").toggle();
        $("#pass3").toggle();
    });
});

// đưa data userupdate đến xử lý

$(document).ready(function(){    
    $("#submitUpdate").click(function(e){
        e.preventDefault();
        var id_update=$('#ID').val();
        if ($('#customCheck').is(':checked'))
        {
            var data={
                'names':$('#nameUpdate').val(),
                'emails':$('#emailUpdate').val(),
                'group_roles':$('#role').val(),
                'checks':$('#customCheck').prop('checked'),
                'password':$('#oldpass').val(),
                'newpass':$('#newpass').val(),
                'renewpass':$('#renewpass').val(),            
            }
        }
        else
        {
            var data={
                'names':$('#nameUpdate').val(),
                'emails':$('#emailUpdate').val(),
                'group_roles':$('#role').val(),
                'checks':$('#customCheck').prop('checked'),           
            }
        }       
        console.log(data);
        $.ajax({
            url:'/admin/user/update/' + id_update,
            type:"put",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:data,
            dataType:'json',
            success:function(response){
                if(response.status==412)
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
                    window.location.reload();
                }                
            },
            error: function (err) {
                alert('Lỗi');
            }
        });
    });
});

$(document).ready(function(){    
    $(".btAddUser").click(function(e){
        e.preventDefault();
        $('#AddUserModal').modal('show');
    });    
});
$(document).ready(function(){
    $(".close").click(function(e){
        $('#AddUserModal').modal('hide');
        window.location.reload();
    });
});
// thêm use bằng ajax
$(document).ready(function(){
    $("#btSubmitAdd").click(function(e){
        e.preventDefault();
        var data={
            'name':$('#addtxtname').val(),
            'email':$('#addemail').val(),
            'password':$('#addpassword').val(),
            'repass':$('#addrepass').val(),
            'group_role':$('#addgroup_role').val(),
            'active':$('#addactive').prop('checked'),            
        }   
        $.ajax({
            url:'/admin/user/add',
            type:"post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:data,
            dataType:'json',
            success:function(response){    
                if(response.status==400)
                {
                    $(".print-error-msg").css('display','block');
                    $('#error_mes').html('');
                    $('#error_mes').addClass('alert alert_danger');
                    $.each(response.errors, function(keys, err_values){
                        $('#error_mes').append('<li>'+err_values+'</i>');
                    });
                }
                else
                {
                    $('#AddUserModal').modal('hide');
                    window.location.reload();
                }
            },
            error: function (err) {
                alert('Lỗi');
            }
        });        
    });
    
});

//Alert Delete
$(document).ready(function(){    
    $(".btDelete").click(function(e)
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
});
// Xác nhận xóa
$(document).ready(function(){    
    $(".btDSubmitDelete").click(function(e)
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
                window.location.reload();
            },
            error: function (err)
            {
                alert('Lỗi');
            }
        });
    });
});


//Alert Block
$(document).ready(function(){    
    $(".btBlock").click(function(e)
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
});
// Xác nhận block/open
$(document).ready(function(){    
    $(".btDSubmitBlock").click(function(e)
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
                window.location.reload();
            },
            error: function (err)
            {
                alert('Lỗi');
            }
        });
    });
});

