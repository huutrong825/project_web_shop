$(document).ready(function(){

    fetch_order();
    // Đổ data ra bảng
    function fetch_order()
    {  
        $('#myTable').DataTable({
            'processing':true,
            'serverSide':true,
            'ajax':
            {
                url : '/admin/order/fetch',
                // data : function (d){
                //     d.key = $('#keySearch').val();
                //     d.pricefrom = $('#price_from').val();
                //     d.priceto = $('#price_to').val();
                //     d.state = $('#state').val();
                // }
            },
            'columns':[
                {'data' : 'order_id', 'visiable' : false},
                {'data' : 'customer_name'},
                {'data' : 'order_date'},
                {'data' : 'receive_date'},
                {'data' : 'type_payment'},
                {'data' : 'total_price'},
                {'data' : 'state_name'},
            ],
        });

        
        // $('#formSearch').on('keyup click' ,function(e) {
        //     $('#myTable').DataTable().draw();
        //     e.preventDefault();
        // });
    }

    $(document).on('click', '.btDetail', function(e){
        e.preventDefault();
        var id = $(this).attr('value');
        $('#DetailOrder').modal('show');
        
        $('#DetailTable').DataTable({
            'processing':true,
            'serverSide':true,
            'ajax':
            {
                url : '/admin/order/detail/' + id,
                method : 'get'
            },
            'columns':[
                {'data' : 'product_name'},
                {'data' : 'quanity_order'},
                {'data' : 'price'},
                {'data' : 'action'},
            ],
            
            // $.ajax({
            //     url : '/admin/order/detail/' + id,
            //     type: 'get',
            //     success: function(response){
            //         $.each(response.order, function(key,item){
            //             $('#cus_name').html(item.customer_name);
            //             $('#address').html(item.address);
            //         });
            //         console.log(response);
        });
    });
});