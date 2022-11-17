$(document).ready(function(){
    $(document).on('click','#changepass', function(e){
        e.preventDefault();
        $('#NewPassword').modal('show');
    });
    $(document).ready(function(){
        $('#formpassword').validate({
            'rules' :{
                'password':'required',
                'newpass' : {
                    'required' : true,
                    'minlength' : 6,
                },
                'repass' : {
                    'required' : true,
                    'equalTo' : '#newpass',
                },
            },
            'messages' :{
                'password': 'Mật khẩu không được trống',
                'newpass' : {
                    'required' : 'Mật khẩu không được trống',
                    'minlength' : 'Không nhỏ hơn 6 ký tự'
                },
                'repass': {
                    'required' : 'Mật khẩu không được trống',
                   'equalTo' : 'Mật khẩu nhập lại không đúng'
                },
            }
        });
    });
    $(document).on('click','.btsave',function(e){
        e.preventDefault();
        // $('#formpassword').submit();
        $.ajax({
            url:'/admin/profile/changepass',
            type: 'post',
            data: new FormData($('#formpassword')[0]),
            contentType: false,
            processData: false,
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response)
            {      
                if (response.state == 200) {
                    $(".alert-success").css('display','block');
                    $('.alert-success').html(response.messages);
                    $('#NewPassword').modal('hide');
                } else if (response.state == 402) {
                    $('.is-danger').html(response.messages);
                }
            },           
        });
    })
});