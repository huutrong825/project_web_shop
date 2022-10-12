$(document).ready(function(){    
    $("#add_user").click(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:"post",
            url:'/admin/user',
            data:{
               name:$("#txtname").val(),
               email:$("#email").val(),
               password:$("password").val(),
               group_role:$("#group_role").val(),
            },
            success:function(data){
                $("#txtname").trigger("reset");
                $("#email").trigger("reset");
                $("password").trigger("reset");
                $("#group_role").trigger("reset");
                window.location.reload();
            }
        });
    });
});