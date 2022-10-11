<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('order_state')->insert([
            'order_state'=>'Đang xử lý',
            'created_at'=>date("Y-m-d"),
            'updated_at'=>date("Y-m-d")            
        ],[
            'order_state'=>'Đang giao',
            'created_at'=>date("Y-m-d"),
            'updated_at'=>date("Y-m-d") 
        ],[
            'order_state'=>'Hoàn thành',
            'created_at'=>date("Y-m-d"),
            'updated_at'=>date("Y-m-d") 
        ],[
            'order_state'=>'Đã hủy',
            'created_at'=>date("Y-m-d"),
            'updated_at'=>date("Y-m-d") 
        ]);
    }
}
