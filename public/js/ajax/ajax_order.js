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
                data : function (d){
                    d.key = $('#keySearch').val();
                    d.orderday = $('#orderday').val();
                    d.receiveday = $('#receiveday').val();
                    d.state = $('#state').val();
                }
            },
            'columns':[
                {'data' : 'order_id',},
                {'data' : 'customer_name'},
                {'data' : 'order_date'},
                {'data' : 'receive_date'},
                {'data' : 'cancel_date'},
                {'data' : 'type_payment'},
                {'data' : 'total_price'},
                {'data' : 'state_name'},
            ],
            'order': [[0, 'desc']],
            'searching':false,
        });
        
        $('#formSearch').on('keyup change' ,function(e) {
            $('#myTable').DataTable().draw();
            e.preventDefault();
        });
    }
        // reset
        $(document).on('click','#btReset' ,function() {
            $('#keySearch').val('');
            $('#orderday').val('');
            $('#receiveday').val('');
            $('#state').val($('#state option:first').val());
            $('#myTable').DataTable().destroy();
            fetch_order();
        });
    fetch_processing();
    // Đổ data ra bảng xử lý
    function fetch_processing()
    {  
        $('#processTable').DataTable({
            'processing':true,
            'serverSide':true,
            'ajax':
            {
                url : '/admin/order/fetchprocess',
                data : function (d){
                    d.key = $('#keySearch').val();
                    d.orderday = $('#orderday').val();
                    d.type_payment = $('#type_payment').val();
                    d.state = $('#state').val();
                }
            },
            'columns':[
                {'data' : 'order_id', },
                {'data' : 'customer_name'},
                {'data' : 'order_date'},
                {'data' : 'type_payment'},
                {'data' : 'total_price'},
                {'data' : 'state_name', 'orderable' : false, 'searchable' : false},
                {'data' : 'action', 'orderable' : false, 'searchable' : false}
            ],
            'order': [[0, 'desc']],
            'searching':false,
        });
        
        $('#formSearch').on('keyup change' ,function(e) {
            $('#processTable').DataTable().draw();
            e.preventDefault();
        });
    }
        // reset
        $(document).on('click','#btReset' ,function() {
            $('#keySearch').val('');
            $('#orderday').val('');
            $('#type_payment').val($('#type_payment option:first').val());
            $('#state').val($('#state option:first').val());
            $('#processTable').DataTable().destroy();
            fetch_processing();
        });
    fetch_complete();
    // Đổ data ra bảng xử lý
    function fetch_complete()
    {  
        $('#completeTable').DataTable({
            'processing':true,
            'serverSide':true,
            'ajax':
            {
                url : '/admin/order/fetchcomplete',
                data : function (d){
                    d.key = $('#keySearch').val();
                    d.orderday = $('#orderday').val();
                    d.receiveday = $('#receiveday').val();
                    d.cancelday = $('#cancelday').val();
                    d.state = $('#state').val();
                }
            },
            'columns':[
                {'data' : 'order_id'},
                {'data' : 'customer_name'},
                {'data' : 'order_date'},
                {'data' : 'receive_date'},
                {'data' : 'cancel_date'},
                {'data' : 'reason_cancel'},
                {'data' : 'state_name'},
            ],
            'order': [[0, 'desc']],
            'searching':false,
        });
        
        $('#formSearch').on('keyup change' ,function(e) {
            $('#completeTable').DataTable().draw();
            e.preventDefault();
        });
    }

    // reset
    $(document).on('click','#btReset' ,function() {
        $('#keySearch').val('');
        $('#orderday').val('');
        $('#receiveday').val('');
        $('#cancelday').val('');
        $('#state').val($('#state option:first').val());
        $('#completeTable').DataTable().destroy();
        fetch_complete();
    });

    $(document).on('click', '.btDetail', function(e){
        e.preventDefault();
        var id = $(this).attr('value');
        $('#DetailOrder').modal('show');
        $.ajax({
            url : '/admin/order/info/' + id,
            type: 'get',
            success: function(response){
                $.each(response.order, function(key,item){
                    $('#cus_name').html(item.customer_name);
                    $('#time').html(item.order_date);
                    $('#phone').html(item.phone);
                    $('#address').html(item.address);
                    $('#email').html(item.email);
                    $('#notes').html(item.description);
                    $('#Total').html(item.total_price);
                });
            }
        });
        table = $('#DetailTable').DataTable({
            'ajax':
            {
                url : '/admin/order/detail/' + id,
                method : 'get'
            },
            'columns':[
                {'data' : 'product_name'},
                {'data' : 'quanity_order'},
                {'data' : 'price'},
                {'data' : 'into_money'},
            ],
            'searching':false,
            'ordering': false,
            'paging': false,
            'info':false
        });
        table.destroy();
    });

    // reset
    $(document).on('click','#btReset' ,function() {
        $('#keySearch').val('');
        $('#price_from').val('');
        $('#price_to').val('');
        $('#state').val($('#state option:first').val());
        $('#myTable').DataTable().destroy();
        fetch_order();
    });

    // export PDF
    $(document).on('click', '.btExportPDF', function(){
        html2canvas($('#detailPDF')[0],{
            onrendered: function(canvas) {
                var data = canvas.toDataURL();
                var docDefinition = {
                    content: [{
                        image: data,
                        width: 500,
                    }]
                };
                var number = 1 + Math.floor(Math.random() * 6);
                $name = 'detail_order' + number + '.pdf';
                pdfMake.createPdf(docDefinition).download($);
            }
        });
    });
    
    //cập nhật trạng thái đơn hàng
    $(document).on('click', '.btState', function(e){
        e.preventDefault();
        var id = $(this).attr('value');
        var data = {
            'state' : $('#selecteState').val()
        }
        $.ajax({
            url : '/admin/order/stateUp/' + id,
            type: 'put',
            data: data,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
                alertify.success(response.messages);
                $('#myTable').DataTable().ajax.reload();
            }
        });
    });
});