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

    var datas = [];
    var label = [];

    $.ajax({
        url: '/admin/statistical/fetch',
        type: 'get',
        success: function(response){
            $('#sum_total').html(number_format(response.array.sum_total,2,',', ' '));
            $('#sum_sale').html(response.array.sum_sale);
            $('#sum_order').html(response.array.sum_order);
            $('#complete_order').html(response.array.complete_order);
            $('#cancel_order').html(response.array.cancel_order);
            $('#quanity').html(number_format(response.array.quanity,0,',',' '));
            $('#myAreaChart').html(response.chart);
            $.each(response.order, function(key, item){
                datas.push(item.total_price);
                label.push(item.order_date);
            });

            
            
        },

    });
    
    $e = ['1','2','3','4','5'];

    console.log($e);
    console.log(datas);

    const data = {
        labels: $e,
        datasets: [{
            type: 'line',
            label: 'My First dataset',
            backgroundColor: 'blue',
            borderColor: 'blue',
            data: ['120000','100000','195000','50000','10000'],
        },
        {
            type:'bar',
            label: 'My First dataset',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: ['50000','120000','20000','30000','2000'],
        }]
    };
    const config = {
        data: data,
        options: {
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
            labels: [
                'Đơn hàng đang vận chuyển',
                'Đang giao',
                'Đã hủy',
                'Hoàn thành',
                'Đang xử lý'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [11, 16, 7, 3, 14],
                backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(75, 192, 192)',
                'rgb(255, 205, 86)',
                'rgb(201, 203, 207)',
                'rgb(54, 162, 235)'
                ]
            }]
            };
            const config1 = {
            type: 'polarArea',
            data: data1,
            options: {

            }
            };
    
            const popalChart = new Chart(
            document.getElementById('popalChart'),
            config1
            );
});

