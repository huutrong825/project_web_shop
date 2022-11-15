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

   

    $.ajax({
        url: '/admin/statistical/fetch',
        type: 'get',
        success: function(response){
            $('#sum_total').html(number_format(response.array.sum_total, 2, ',', ' '));
            $('#sum_sale').html(response.array.sum_sale);
            $('#sum_order').html(response.array.sum_order);
            $('#complete_order').html(response.array.complete_order);
            $('#cancel_order').html(response.array.cancel_order);
            $('#quanity').html(number_format(response.array.store, 0, ',', ' '));
            $('#fee_add').html(number_format(response.array.fee_add, 2, ',', ' '));
            $('#product_add').html(number_format(response.array.product_add, 0, ',', ' '));

            
            const data = {
                labels: response.date,
                datasets: [{
                    type: 'line',
                    label: 'Tiền đơn hàng',
                    backgroundColor: 'rgb(117, 176, 235)',
                    borderColor: 'rgb(117, 176, 245)',
                    data: response.data,
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
                labels: response.date_add,
                datasets: [
                    {
                        type: 'line',
                        label: 'Sô lượng nhập',
                        data: response.sum_quanity,
                        backgroundColor: ['rgba(75, 192, 192, 0.2)'],
                        borderColor: ['rgb(75, 192, 192)'],
                        borderWidth: 1
                    },
                    {
                        type: 'line',
                        label: 'Giá nhập',
                        data: response.sum_price,
                        backgroundColor: ['rgb(255, 205, 86)'],
                        borderColor:['rgb(255, 205, 80, 0.5)'],
                        
                    }
                ]
                };
                const config1 = {
                data: data1,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                          beginAtZero: true
                        },
                    }
                }
                };
        
                const popalChart = new Chart(
                document.getElementById('myChart1'),
                config1
                );
            
        },

    });
   
});

