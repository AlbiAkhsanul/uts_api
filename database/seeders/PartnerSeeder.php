<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Partner;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            ['nama_partner' => 'PT. Karya Bangun', 'negara_asal' => 'ID'],
            ['nama_partner' => 'Global Build Co.', 'negara_asal' => 'SG'],
            ['nama_partner' => 'TechnoArch Design', 'negara_asal' => 'MY'],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}
