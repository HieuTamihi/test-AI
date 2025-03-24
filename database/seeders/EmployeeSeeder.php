<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees = [
            ['group' => 'Nhóm 1', 'employee_code' => 'EMP001', 'email' => 'employee1@example.com', 'password' => Hash::make('password123'), 'position' => 'Trưởng phòng', 'name' => 'Nguyễn Văn A', 'address' => 'Hà Nội', 'phone' => '0123456789'],
            ['group' => 'Nhóm 1', 'employee_code' => 'EMP002', 'email' => 'employee2@example.com', 'password' => Hash::make('password123'), 'position' => 'Trưởng nhóm', 'name' => 'Trần Thị B', 'address' => 'Hồ Chí Minh', 'phone' => '0987654321'],
            ['group' => 'Nhóm 2', 'employee_code' => 'EMP003', 'email' => 'employee3@example.com', 'password' => Hash::make('password123'), 'position' => 'Nhân viên', 'name' => 'Lê Văn C', 'address' => 'Đà Nẵng', 'phone' => '0912345678'],
            ['group' => 'Nhóm 2', 'employee_code' => 'EMP004', 'email' => 'employee4@example.com', 'password' => Hash::make('password123'), 'position' => 'Trưởng phòng', 'name' => 'Phan Thị D', 'address' => 'Cần Thơ', 'phone' => '0934567890'],
        ];

        DB::table('employees')->insert($employees);
    }
}
