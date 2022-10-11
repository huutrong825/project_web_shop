<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('admin_user')->insert([
            'name'=>'Dang Vu',
            'email'=>'vu1@gmail.com',
            'password'=>Hash::make('1234'),
            'group_role'=>1,
            'created_at'=>date("Y-m-d"),
            'updated_at'=>date("Y-m-d") 
        ]);
    }
}
