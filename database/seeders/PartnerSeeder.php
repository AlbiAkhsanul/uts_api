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
            ['nama_partner' => 'PT. Karya Bangun', 'negara_asal' => 'ID', 'email' => 'karyabangun54@gmail.com', 'no_telepon' => '081559596145'],
            ['nama_partner' => 'Global Build Co.', 'negara_asal' => 'SG', 'email' => 'globuild11@gmail.com', 'no_telepon' => '081559596127'],
            ['nama_partner' => 'TechnoArch Design', 'negara_asal' => 'MY', 'email' => 'technoarch23@gmail.com', 'no_telepon' => '081559596188'],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}
