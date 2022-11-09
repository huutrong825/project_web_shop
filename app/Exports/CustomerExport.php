<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerExport implements FromCollection, WithHeadings
{
    
    // public function __construct(int $id) 
    // {
    //       $this->id = $id;
    // }

    public function collection()
    {
        return Customer::all();
    }

    public function headings() :array 
    {
        return ["STT", "Họ Tên", "Email", "Điện thoại", "Địa chỉ", "Ngày tạo", "Ngày cập nhật"];
    }
}

