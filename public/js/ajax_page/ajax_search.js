$(document).ready(function(){

    $(document).on('click', '.search ', function(e){
        e.preventDefault();
        var key = $('#search').val();
        window.location = '/search?' + $.param(key);
    });

    

 

   
});