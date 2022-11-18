$(document).ready(function (){

    fetch_customer();
    // Đổ data ra bảng
    function fetch_customer()
    {
        $('#myTable').DataTable({
            'processing' : true,
            'serverSide' : true,
            'ajax':
            {
                url : '/admin/customer/fetch',
                data : function (d){
                    d.key = $('#keySearch').val();
                    d.phone = $('#phone').val();
                    d.address = $('#address').val();
                    d.email = $('#email').val();
                },
                
            },
            'columns':[
                { 'data' : 'customer_id', 'visible':false},
                { 'data' : 'customer_name' },
                { 'data' : 'email' },
                { 'data' : 'phone' },
                { 'data' : 'address' },
                { 'data' : 'num_order' },
                { 'data' : 'action', 'orderable' : false,'searchable' : false},
            ],
            'order' : [[0, 'desc']],
            'searching':false,
        });   
        $('#formSearch').on('keyup' ,function(e) {
            $('#myTable').DataTable().draw();
            e.preventDefault();
        });
    }
    // reset
    $(document).on('click','#btReset' ,function() {
        $('#keySearch').val('');
        $('#phone').val('');
        $('#address').val('');
        $('#email').val('');
        $('#myTable').DataTable().destroy();
        fetch_customer();
    });

    // $(document).on('click', '.bt-Add',function(e)
    // {
    //     e.preventDefault();
    //     $('#AddModal').modal('show');
    // });

    // $('#addForm').validate({
    //     rules :
    //     {
    //         'name' : 'required',
    //         'email' : 'required',
    //         'address' : 'required',
    //         'phone' : 'required'
    //     },
    //     messages:
    //     {
    //         'name' : 'Tên không được trống',
    //         'email' : 'Email không được trống',
    //         'address' : 'Địa chỉ không được trống',
    //         'phone' : 'Số điện thoại không được trống'
    //     }
    // });

    // $(document).on('click', '.btSubmitAdd',function(e)
    // {
    //     e.preventDefault();
    //     $('#addForm').submit();
    //     $.ajax({
    //         url : '/admin/customer/add',
    //         type : 'post',
    //         data : new FormData($('#addForm')[0]),
    //         contentType: false,
    //         processData: false,
    //         dataType : 'json',
    //         headers : {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         success:function(response)
    //         {  
    //             $('#AddModal').modal('hide');
    //             $('#AddModal').reset();
    //             $('#myTable').DataTable().ajax.reload();
    //             $('.alert-success').hide(8000);
    //         },
    //         error: function (err)
    //         {
    //             $('#addForm').validate().messages;
    //         }
    //     });
    // });

    $(document).on('click', '.bt-Update', function(e){
        e.preventDefault();
        var id = $(this).attr('value');
        $('#UpdateModal').modal('show');
        $.ajax({
            url : '/admin/customer/getId/' + id,
            type : 'get',
            success : function(response){
                $.each(response.cus, function(key, item){
                    $('#idUp').val(item.customer_id);
                    $('#nameUp').val(item.customer_name);
                    $('#emailUp').val(item.email);
                    $('#phoneUp').val(item.phone);
                    $('#addressUp').val(item.address);
                });
            }
        });
    });

    $(document).on('click', '.btSubmitUpdate', function(e){
        e.preventDefault();
        var id = $('#idUp').val();
        var data =
        {
            'nameUp' : $('#nameUp').val(),
            'emailUp' : $('#emailUp').val(),
            'phoneUp' : $('#phoneUp').val(),
            'addressUp' : $('#addressUp').val()
        }
        $.ajax({
            url : '/admin/customer/update/' + id,
            type : 'put',
            data : data,
            dataType : 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success : function(response){

            },
            error : function(err)
            {
                alert('Lỗi');
            }
        });
    });

    
    $(document).on('click','#exportExcel',function(e){
        e.preventDefault();

        var key = $('#keySearch').val();
        var phone = $('#phone').val();
        var address = $('#address').val();
        var email = $('#email').val();

        var data;

        if (key != '' || phone != '' || address != '' || email != '') {
           data = {
                key : key,
                phone : phone,
                address : address,
                email : email
            }
        }

        window.location = '/admin/customer/export?' + $.param(data);
        
    });

    $(document).on('click', '#tableExcel', function(e){
        e.preventDefault();
        $('#myTable').table2excel({
            exclude: ".noExport",
            filename: "name-of-the-file",
        });
    });
});