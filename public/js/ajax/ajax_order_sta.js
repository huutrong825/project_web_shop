$(document).ready(function() {

    const data = {
        labels: [],
        datasets: [{
            label: 'Đơn hàng',
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(238, 169, 124)',
                'rgb(28, 222, 162)',
                'rgb(255, 0, 0)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(238, 169, 124)',
                'rgb(28, 222, 162)',
                'rgb(255, 0, 0)'
            ],
            data: [],
            
        }],
    };
    const config = {
        type: 'doughnut',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    };
    const myChart = new Chart(
        document.getElementById('doughnutChart'),
        config
    );

    $.ajax({
        url: '/admin/statistical/fetch_order',
        type: 'get',
        data : function (d){
            d.fromDate = $('#fromDate').val();
            d.toDate = $('#toDate').val();
            d.type = $('#type').val();
        },
        success: function(response){
            $('#sum_order').html(response.data.sum_order);
            $('#sum_prod').html(response.data.sum_prod);
            $('#num_prod').html(response.data.num_prod);
            
            myChart.data.datasets[0].data = response.count;
            myChart.data.labels = response.stated;
            myChart.update();            
        }
    });

    $('#formSearch').on('change' ,function(e) {
        e.preventDefault();
        var data = {
            'fromDate' : $('#fromDate').val(),
            'toDate' : $('#toDate').val(),
        };
        $.ajax({
            url: '/admin/statistical/fetch_order',
            type: 'get',
            data : data,
            success: function(response){
                $('#sum_order').html(response.data.sum_order);
                $('#sum_prod').html(response.data.sum_prod);
                $('#num_prod').html(response.data.num_prod);

                myChart.data.datasets[0].data = response.count;
                myChart.data.labels = response.stated;
                myChart.update();
            }
        });   
    });

    fetch_datatable();

    function fetch_datatable()
    {
        $('#myTable').DataTable({
            'processing' : true,
            'serverSide' : true,
            'ajax':
            {
                url : '/admin/statistical/datatable',
                data : function (d){
                    d.fromDate = $('#fromDate').val();
                    d.toDate = $('#toDate').val();
                },
                
            },
            'columns':[
                { 'data' : 'product_name' },
                { 'data' : 'money' },
                { 'data' : 'quanity_order' },
                { 'data' : 'num_order'}
            ],
            'order' : [[1, 'desc']],
            'searching':false,
            'paging': false,
            'info' :false
        });   
        $('#formSearch').on('keyup change' ,function(e) {
            $('#myTable').DataTable().draw();
            e.preventDefault();
        });
    }

    $('#exportExcel').on('click', function(e){
        e.preventDefault();

        var fromDate = $('#fromDate').val();
        var toDate = $('#toDate').val();

        var data;

        if (fromDate!= '' || toDate != '' ) {
           data = {
                toDate : toDate,
                fromDate : fromDate,
            }
        }

        window.location = '/admin/statistical/export?' + $.param(data);
    });

    $(document).on('click', '#btPDF', function(){
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

    $(document).on('click','#btReset' ,function() {
        $('#fromDate').val('');
        $('#toDate').val('');
    });
});