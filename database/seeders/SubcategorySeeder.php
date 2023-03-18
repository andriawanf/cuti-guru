<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subcategory::create([
            'title' => 'Cuti Besar',
        ]);
        Subcategory::create([
            'title' => 'Cuti Sakit',
        ]);
        Subcategory::create([
            'title' => 'Cuti Bersalin',
        ]);
        Subcategory::create([
            'title' => 'Cuti Karena Alasan Penting',
        ]);
        Subcategory::create([
            'title' => 'Cuti Diluar Tanggungan Negara',
        ]);
        Subcategory::create([
            'title' => 'Cuti Ibadah Haji',
        ]);
    }
}
