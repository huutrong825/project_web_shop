function number_format(number, decimals, dec_point, thousands_sep) {
// *     example: number_format(1234.56, 2, ',', ' ');
// *     return: '1 234,56'
number = (number + '').replace(',', '').replace(' ', '');
var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
    var k = Math.pow(10, prec);
    return '' + Math.round(n * k) / k;
    };
// Fix for IE parseFloat(0.55).toFixed(0) = 0;
s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
}
if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
}
return s.join(dec);
}


$(document).ready(function(){

    const data = {
        labels: [],
        datasets: [{
            type: 'line',
            label: 'Tiền đơn hàng',
            backgroundColor: 'rgb(117, 176, 235,0.5)',
            borderColor: 'rgb(117, 176, 245)',
            tension: 0.4 ,
            data: [],
        }],
    };
    const config = {
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );


    const data1 = {
        labels: [],
        datasets: [
            {
                type: 'line',
                label: 'Số lượng nhập',
                data: [],
                backgroundColor: ['rgb(255, 0, 0, 0.5)'],
                borderColor:['rgb(255, 0, 0, 0.5)'],
                tension: 0.4               
            },
            {
                type: 'bar',
                label: 'Giá nhập',
                data: [],
                backgroundColor: ['rgba(75, 192, 192,0.5)'],
                borderColor: ['rgb(75, 192, 192, 0.6)'],
                tension: 0.4,
                yAxisID: 'percentage'
            },
            
        ]
        };
        const config1 = {
            data: data1,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Số lượng nhập'
                        }
                    },
                    percentage: {
                        // beginAtZero: true,
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Giá nhập'
                        }
                    },
                    
            }
        }
        };

        const myChart1 = new Chart(
        document.getElementById('myChart1'),
        config1
        );
    

    fetch();
    function fetch(time){
        $.ajax({
            data: {'time': time},
            url: '/admin/statistical/fetch',
            type: 'get',
            data : function(d)
            {
                d.time = $('#time-filter').val();
            },
            success: function(response){
                $('#sum_total').html(number_format(response.array.sum_total, 2, ',', ' '));
                $('#sum_sale').html(response.array.sum_sale);
                $('#sum_order').html(response.array.sum_order);
                $('#complete_order').html(response.array.complete_order);
                $('#cancel_order').html(response.array.cancel_order);
                $('#quanity').html(number_format(response.array.store, 0, ',', ' '));
                $('#fee_add').html(number_format(response.array.fee_add, 2, ',', ' '));
                $('#product_add').html(number_format(response.array.product_add, 0, ',', ' ')); 
                
                myChart.data.datasets[0].data = response.data;
                myChart.data.labels = response.date;
                myChart.update();

                myChart1.data.datasets[0].data = response.sum_quanity;
                myChart1.data.datasets[1].data = response.sum_price;
                myChart1.data.labels = response.date_add;
                myChart1.update();
            },

        });
        $('#time-filter').on('change', function(e){
            e.preventDefault();
            var time = $(this).val();
            $.ajax({
                data: {'time': time},
                url: '/admin/statistical/fetch',
                type: 'get',
                data : {'time': time},
                success: function(response){
                    $('#sum_total').html(number_format(response.array.sum_total, 2, ',', ' '));
                    $('#sum_sale').html(response.array.sum_sale);
                    $('#sum_order').html(response.array.sum_order);
                    $('#complete_order').html(response.array.complete_order);
                    $('#cancel_order').html(response.array.cancel_order);
                    $('#quanity').html(number_format(response.array.store, 0, ',', ' '));
                    $('#fee_add').html(number_format(response.array.fee_add, 2, ',', ' '));
                    $('#product_add').html(number_format(response.array.product_add, 0, ',', ' '));
                    
                    myChart.data.datasets[0].data = response.data;
                    myChart.data.labels = response.date;
                    myChart.update();
    
                    myChart1.data.datasets[0].data = response.sum_quanity;
                    myChart1.data.datasets[1].data = response.sum_price;
                    myChart1.data.labels = response.date_add;
                    myChart1.update();
                },
            });
        });
    }

    $('#formSearch').on('change' ,function(e) {
        e.preventDefault();
        var data = {
            'fromDate' : $('#fromDate').val(),
            'toDate' : $('#toDate').val(),
        };
        $.ajax({
            url: '/admin/statistical/fetch',
            type: 'get',
            data : data,
            success: function(response){
                $('#sum_total').html(number_format(response.array.sum_total, 2, ',', ' '));
                    $('#sum_sale').html(response.array.sum_sale);
                    $('#sum_order').html(response.array.sum_order);
                    $('#complete_order').html(response.array.complete_order);
                    $('#cancel_order').html(response.array.cancel_order);
                    $('#quanity').html(number_format(response.array.store, 0, ',', ' '));
                    $('#fee_add').html(number_format(response.array.fee_add, 2, ',', ' '));
                    $('#product_add').html(number_format(response.array.product_add, 0, ',', ' '));
                    
                    myChart.data.datasets[0].data = response.data;
                    myChart.data.labels = response.date;
                    myChart.update();
    
                    myChart1.data.datasets[0].data = response.sum_quanity;
                    myChart1.data.datasets[1].data = response.sum_price;
                    myChart1.data.labels = response.date_add;
                    myChart1.update();
            }
        });   
    });
   
});

