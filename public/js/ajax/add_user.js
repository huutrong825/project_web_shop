$(document).ready(function(){    
    $("#txtSearch").keyup(function(){
        var search=$(this).val();
        $.ajax({
        })
        // $.ajax({
        //     type:"get",
        //     url:"/admin/user",
        //     data:{
        //         search:$('#txtSearch').val()
        //     },
        //     success:function(data){
        //         $(".container-fluid").html(data).show();
        //     }
        // });
    });
});