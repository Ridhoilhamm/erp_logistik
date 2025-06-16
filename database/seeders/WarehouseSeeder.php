<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $datas = [
            [
                'name' => 'Gudang Utama Jakarta',
                'address' => 'Jl. Gatot Subroto No.1, Jakarta',
                'phone' => '021-1234567',
            ],
            [
                'name' => 'Gudang Surabaya',
                'address' => 'Jl. Ahmad Yani No.23, Surabaya',
                'phone' => '031-7654321',
            ],
            [
                'name' => 'Gudang Bandung',
                'address' => 'Jl. Asia Afrika No.45, Bandung',
                'phone' => '022-8888888',
            ],
            [
                'name' => 'Gudang Makassar',
                'address' => 'Jl. Pengayoman No.9, Makassar',
                'phone' => '0411-999999',
            ],
            [
                'name' => 'Gudang Medan',
                'address' => 'Jl. Sisingamangaraja No.77, Medan',
                'phone' => '061-7777777',
            ],
            [
                'name' => 'Gudang Yogyakarta',
                'address' => 'Jl. Malioboro No.15, Yogyakarta',
                'phone' => '0274-123123',
            ],
            [
                'name' => 'Gudang Palembang',
                'address' => 'Jl. Sudirman No.50, Palembang',
                'phone' => '0711-456456',
            ],
            [
                'name' => 'Gudang Balikpapan',
                'address' => 'Jl. Jend. Sudirman No.101, Balikpapan',
                'phone' => '0542-987654',
            ],
            [
                'name' => 'Gudang Semarang',
                'address' => 'Jl. Pandanaran No.20, Semarang',
                'phone' => '024-555666',
            ],
            [
                'name' => 'Gudang Denpasar',
                'address' => 'Jl. Diponegoro No.34, Denpasar',
                'phone' => '0361-343434',
            ],
        ];

        foreach ($datas as $data) {
            Warehouse::create([
                'name' => $data['name'],
                'address' => $data['address'],
                'phone' => $data['phone'],
            ]);
        }
    }
}
