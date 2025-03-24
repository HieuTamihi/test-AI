<?php

namespace Database\Seeders;
use App\Models\Supplier;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::insert([
            ['group' => 'Nhà Cung Cấp', 'supplier_code' => 'SUP001', 'name' => 'Công Ty A', 'address' => 'Địa chỉ A', 'phone' => '0123456789', 'email' => 'a@gmail.com', 'tax_code' => '123456789', 'notes' => 'Ghi chú A'],
            ['group' => 'Nhà Phân Phối', 'supplier_code' => 'SUP002', 'name' => 'Công Ty B', 'address' => 'Địa chỉ B', 'phone' => '0987654321', 'email' => 'b@gmail.com', 'tax_code' => '987654321', 'notes' => 'Ghi chú B'],
        ]);
        
    }
}
