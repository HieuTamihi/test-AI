<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warehouse;

class WarehouseSeeder extends Seeder
{
    public function run()
    {
        Warehouse::create([
            'warehouse_code' => 'WH001',
            'name' => 'Kho Hà Nội',
            'address' => 'Số 1, Hà Nội, Việt Nam',
        ]);

        Warehouse::create([
            'warehouse_code' => 'WH002',
            'name' => 'Kho TP.HCM',
            'address' => 'Số 2, TP.HCM, Việt Nam',
        ]);

        // Thêm dữ liệu mẫu khác nếu cần
    }
}
