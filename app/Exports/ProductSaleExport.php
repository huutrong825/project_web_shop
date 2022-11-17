<?php

namespace App\Exports;

use App\Models\Product;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class ProductSaleExport implements FromQuery, ShouldAutoSize, WithHeadings, WithMapping
{
    use Exportable;

    public function __construct($req)
    {
        $this->request = $req;
    }

    public function query()
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $startOfMonth = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()
            ->toDateString();

        $pro = Product::query()->join('order_detail', 'product.product_id', '=', 'order_detail.product_id')
            ->rightJoin('order', 'order.order_id', '=', 'order_detail.order_id')
            ->where('order.state', 5)            
            ->selectRaw(
                'product_name,
                sum(quanity_order * price) as money,
                sum(quanity_order) as quanity_order,
                count(order_detail.order_id) as num_order'
            )->groupBy('product.product_id', 'product_name');

        if ($this->request->fromDate != '' && $this->request->toDate != '') {
            $pro = $pro->whereBetween('order_date', [$this->request->fromDate, $this->request->toDate]);
        } else {
            $pro = $pro->whereBetween('order_date', [$startOfMonth, $now]);
        }

        return $pro;
    }
    public function headings() :array 
    {
        return ["Tên sản phẩm", "Doanh thu bán được", "Số lượng bán", "Số đơn hàng"];
    }

    public function map($product): array
    {
        return [
            $product->product_name,
            $product->money,
            $product->quanity_order,
            $product->num_order
        ];
    }
}
