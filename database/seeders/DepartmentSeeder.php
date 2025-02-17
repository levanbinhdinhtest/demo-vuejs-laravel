<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Chèn nhiều bản ghi vào bảng 'departments'
        DB::table('departments')->insert([
            ['name' => 'Quan Tri'],
            ['name' => 'Khach'],
        ]);
    }
    
}