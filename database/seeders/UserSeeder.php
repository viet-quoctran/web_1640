<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'vietquoctran2502@gmail.com',
            'password' => Hash::make('quocviet'), // Sử dụng Hash::make để mã hóa password
            'role_id' => 1, // Giả sử ID role của Admin là 1
            // Thêm các trường khác theo cấu trúc bảng của bạn
        ]);
        DB::table('users')->insert([
            'name' => 'usera',
            'email' => 'vietshopify2502@gmail.com',
            'password' => Hash::make('quocviet'), // Sử dụng Hash::make để mã hóa password
            'role_id' => 2, // Giả sử ID role của Admin là 1
            // Thêm các trường khác theo cấu trúc bảng của bạn
        ]);
    }
}
