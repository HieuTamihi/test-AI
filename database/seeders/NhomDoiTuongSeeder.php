<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NhomDoiTuongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nhomdoituong')->insert([
            [
                'ma_doi_tuong' => 'KV_HCM',
                'ten_nhom_doi_tuong' => 'Khách hàng HCM',
                'loai_nhom_doi_tuong' => 'Khách hàng',
            ],
            [
                'ma_doi_tuong' => 'KV_HN',
                'ten_nhom_doi_tuong' => 'Khách hàng Hà Nội',
                'loai_nhom_doi_tuong' => 'Khách hàng',
            ],
            [
                'ma_doi_tuong' => 'KV_DN',
                'ten_nhom_doi_tuong' => 'Khách hàng Đà Nẵng',
                'loai_nhom_doi_tuong' => 'Khách hàng',
            ],
            [
                'ma_doi_tuong' => 'KV_DL',
                'ten_nhom_doi_tuong' => 'Khách hàng Đà Lạt',
                'loai_nhom_doi_tuong' => 'Khách hàng',
            ],
            [
                'ma_doi_tuong' => 'NV_KHO',
                'ten_nhom_doi_tuong' => 'Quản kho',
                'loai_nhom_doi_tuong' => 'Nhân viên',
            ],
            [
                'ma_doi_tuong' => 'NV_BH',
                'ten_nhom_doi_tuong' => 'Bảo hành',
                'loai_nhom_doi_tuong' => 'Nhân viên',
            ],
        ]);
    }
}
