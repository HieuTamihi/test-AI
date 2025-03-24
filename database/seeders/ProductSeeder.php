<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['group' => 'Hàng Hóa', 'product_code' => 'X001', 'name' => 'Tên hàng X001', 'brand' => 'HYUNDAI', 'warranty_period' => 12],
            ['group' => 'Hàng Hóa', 'product_code' => 'X002', 'name' => 'Tên hàng X002', 'brand' => 'HYUNDAI', 'warranty_period' => 12],
            ['group' => 'UPS', 'product_code' => 'Y001', 'name' => 'Tên hàng Y001', 'brand' => 'APC', 'warranty_period' => 12],
            ['group' => 'UPS', 'product_code' => 'Y002', 'name' => 'Tên hàng Y002', 'brand' => 'CPA', 'warranty_period' => 12],
        ];

        DB::table('products')->insert($products);
    }
}
