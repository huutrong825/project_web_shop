$(document).ready(function(){

    $(document).on('click', '#addToCart', function(e){
        e.preventDefault();
        var id = $(this).attr('value');
        $.ajax({
            url : '/addToCart/' + id,
            type : 'get',
            success: function(response)
            {
                $('.cart-change').empty();
                $('.cart-change').html(response);
                alertify.success(response.message);
            }
        });
    });

    $(document).on('click', '.btDelPro', function(e){
        e.preventDefault();
        var id = $(this).attr('value');
        console.log(id);
        $.ajax({
            url : '/delOfPro/' + $(this).attr('value'),
            type : 'get',
            success: function(response)
            {
                alertify.success(response.message);
            }
        });
    });

    $(document).on('click change', '.btUpQua', function(e){
        var data = {
            'newQuanity' : $('#changeQua').val()
        }
        var id = $(this).attr('value');
        $.ajax({
            url : '/updatePro/' + id,
            type : 'post',
            data : data,
            dataType : 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response)
            {
                alertify.success(response.message);
            }
        });
    });

    $(document).on('click', '#dathang', function(e){
        $.ajax({
            url : '/sendOrder',
            type : 'post',
            data : new FormData($('#form-dat-hang')[0]),
            contentType: false,
            processData: false,
            dataType : 'json',
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response)
            {
                $(location).attr('href',response.url);
                alertify.success(response.message);
            }
        });
    });
});