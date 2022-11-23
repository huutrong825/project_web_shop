$(document).ready(function(){

    $(document).on('click', '#addToCart', function(e){
        e.preventDefault();
        var id = $(this).attr('value');
        $.ajax({
            url : '/addToCart/' + id,
            type : 'get',
            success: function(response)
            {
                alertify.success(response.message);
            }
        });
    });
});