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
        var checked=$('#customCheck').prop('checked');  
        var data={
            'names':$('#nameUpdate').val(),
            'emails':$('#emailUpdate').val(),
            'group_roles':$('#role').val(),
            'checks':$('#customCheck').prop('checked'),
            'password':$('#oldpass').val(),
            'newpass':$('#newpass').val(),
            'renewpass':$('#renewpass').val(),            
        }
        // if (checked==true)
        // {
        //     $('.modal-body').validate({
        //         rule:{
        //             'oldpass':{
        //                 required:true,
        //                 minlenght:6
        //             },
        //             'newpass':{
        //                 required:true,
        //                 minlenght:6
        //             },
        //             'renewpass':{
        //                 required:true,
        //                 equalTo:'#newpass'
        //             }
        //         },
        //         messages:{
        //             oldpass:{
        //                 required:'Mật khẩu không được trống',
        //                 minlenght:'Mật khẩu không được nhỏ hơn 6 ký tự'
        //             },
        //             newpass:{
        //                 required:'Mật khẩu không được trống',
        //                 minlenght:'Mật khẩu không được nhỏ hơn 6 ký tự'
        //             },
        //             oldpass:{
        //                 required:'Mật khẩu không được trống',
        //                 eqiualTo:'Mật khẩu xác nhận lại chưa đúng'
        //             }
        //         }
        //     });
        // }
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
                // alert('Thành công');
                $('#UpdateUserModal').modal('hide');
                window.location.reload();
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
        $('#form-add-user').validate({
            rule:{
                txtname:"required",
                email:"required",
                password:{
                    required:true,
                    minlenght:6
                },
                repass:{
                    required:true,
                    equalTo:"#addpassword"
                },
                group_role:"required"   
            },
            messages:{
                txtname:"nhập tên"
            }
        });
        
            $.ajax({
                url:'/admin/user/add',
                type:"post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:data,
                dataType:'json',
                success:function(response){                
                    $('#UpdateUserModal').modal('hide');
                    window.location.reload();
                    alert('Thành công');
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

