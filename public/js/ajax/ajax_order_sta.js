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
});