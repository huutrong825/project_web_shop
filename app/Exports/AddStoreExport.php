<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class AddStoreExport implements FromQuery, ShouldAutoSize, WithHeadings, WithMapping
{
    public function __construct($req)
    {
        $this->request = $req;
    }

    public function query()
    {
        $p = Product::query()->join('product_add', 'product_id', '=', 'pro_id')
            ->select( 
                'product_name',
                'quanity_add',
                'price',                
                'date_add',
            );
    
        if ($this->request->pricefrom != '') {
            $p = $p->where('price', '>=', $this->request->pricefrom);
        }

        if ($this->request->priceto != '') {
            $p = $p->where('price', '<=', $this->request->priceto);
        }

        if ($this->request->key != '') {
            $p = $p->where('product_name', 'like', '%'. $this->request->key .'%');
        }

        if ($this->request->fromday != '') {
            $p = $p->where('date_add', '>=', $this->request->fromday);
        }

        if ($this->request->today != '') {
            $p = $p->where('date_add', '<=', $this->request->today);
        }

        $p->get();

        return $p;
    }

    public function headings() :array 
    {
        return ["Tên sản phẩm", "Số lượng nhập", "Giá nhập", "Ngày nhập hàng"];
    }

    public function map($product): array
    {
        return [
            $product->product_name,
            $product->quanity_add,
            $product->price,
            $product->date_add
        ];
    }
}
