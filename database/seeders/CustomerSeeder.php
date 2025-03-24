<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('vi_VN'); // Thiết lập Faker cho tiếng Việt

        // Dữ liệu nhóm Công ty
        foreach (range(1, 4) as $index) {
            DB::table('customers')->insert([
                'group' => 'Công Ty',
                'customer_code' => '000' . $index,
                'name' => 'Công Ty ' . chr(64 + $index), // Công Ty A, Công Ty B, ...
                'address' => $faker->address,
                'phone' => $this->generatePhoneNumber($faker),
                'email' => $faker->unique()->email,
                'tax_code' => $faker->uuid,
                'note' => $faker->sentence,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Dữ liệu nhóm KV-Tĩnh_Miền_Bắc
        foreach (range(1, 4) as $index) {
            DB::table('customers')->insert([
                'group' => 'KV-Tĩnh_Miền_Bắc',
                'customer_code' => '100' . $index,
                'name' => 'Công Ty ' . chr(64 + $index + 4), // Công Ty E, Công Ty F, ...
                'address' => $faker->address,
                'phone' => $this->generatePhoneNumber($faker),
                'email' => $faker->unique()->email,
                'tax_code' => $faker->uuid,
                'note' => $faker->sentence,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Dữ liệu nhóm KV-Tĩnh_Miền_Nam
        foreach (range(1, 4) as $index) {
            DB::table('customers')->insert([
                'group' => 'KV-Tĩnh_Miền_Nam',
                'customer_code' => '200' . $index,
                'name' => 'Công Ty ' . chr(64 + $index + 8), // Công Ty I, Công Ty J, ...
                'address' => $faker->address,
                'phone' => $this->generatePhoneNumber($faker),
                'email' => $faker->unique()->email,
                'tax_code' => $faker->uuid,
                'note' => $faker->sentence,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Generate a valid phone number in Vietnamese format (<= 15 characters).
     *
     * @param \Faker\Generator $faker
     * @return string
     */
    private function generatePhoneNumber($faker)
    {
        // Sử dụng regexify để tạo số điện thoại theo định dạng của Việt Nam
        return '0' . $faker->regexify('[0-9]{9}');
    }
}
