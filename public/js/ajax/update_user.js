$(document).ready(function(){    
    $(".btUpdate").click(function(e){
        e.preventDefault();
        var _id=$(this).attr('value');
        $('#UpdateUserModal').modal('show');
        var typeRole='';        
        $.ajax({
            url:'/admin/user/update/' +_id,
            type:"GET",
            success:function(response){
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
            error: function (err) {
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
        var data={
            'names':$('#nameUpdate').val(),
            'emails':$('#emailUpdate').val(),
            'group_roles':$('#role').val(),
            'checks':$('#customCheck').prop('checked'),
            'password':$('#oldpass').val(),
            'newpass':$('#newpass').val(),
            'renewpass':$('#renewpass').val(),
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