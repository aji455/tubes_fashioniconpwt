<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShippingCost;

class ShippingCostSeeder extends Seeder
{
    public function run(): void
    {
        ShippingCost::insert([
            [
                'name' => 'JNE Reg',
                'price' => 18000,
                'description' => 'Pengiriman reguler 2-3 hari kerja'
            ],
            [
                'name' => 'J&T Express',
                'price' => 17000,
                'description' => 'Estimasi 2-4 hari'
            ],
            [
                'name' => 'SiCepat Regular',
                'price' => 15000,
                'description' => 'Pengiriman ekonomis'
            ],
        ]);
    }
}
