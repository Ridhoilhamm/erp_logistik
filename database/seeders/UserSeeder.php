<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'name' => 'Budi',
                'email' => 'budi@gmail.com',
                'password' => bcrypt(12345678),
            ],
            [
                'name' => 'Randi',
                'email' => 'randi@gmail.com',
                'password' => bcrypt(12345678),
            ],
        ];
        
        foreach ($datas as $data) {
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);
        }
    }
}
