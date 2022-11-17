<?php

namespace App\Exports;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class CustomerExport implements FromQuery, ShouldAutoSize, WithHeadings, WithMapping
{
    use Exportable;
    // protected $customer;
    public function __construct($req)
    {
        $this->request = $req;
    }

    public function query()
    {
        $cus = Customer::query()->join('order', 'order.customer_id', '=', 'customer.customer_id')
            ->selectRaw('customer.customer_id, customer_name, address, email, phone, count(order.customer_id) as num_order')
            ->groupBy('customer.customer_id', 'customer_name', 'address', 'email', 'phone');
        
        if (isset($this->request->phone)) {
            $cus = $cus->where('phone', 'like', '%'. $this->request->phone .'%');
        }
        if (isset($this->request->email)) {
            $cus = $cus->where('email', 'like', '%'. $this->request->email .'%');
        }
        if (isset($this->request->address)) {
            $cus = $cus->where('address', 'like', '%'. $this->request->address .'%');
        }
        if (isset($this->request->key)) {
            $cus = $cus->where('customer_name', 'like', '%'. $this->request->key .'%');
        }
        

        return $cus;
    }

    public function headings() :array 
    {
        return ["STT", "Họ Tên", "Email", "Điện thoại", "Địa chỉ","Số đơn hàng"];
    }

    public function map($customer): array
    {
        return [
            $customer->customer_id,
            $customer->customer_name,
            $customer->email,
            $customer->phone,
            $customer->address,
            $customer->num_order
        ];
    }
}

