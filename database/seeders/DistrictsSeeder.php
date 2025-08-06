<?php

namespace Database\Seeders;

use App\Imports\UgandaDistrictsImport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class DistrictsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Excel::import(new UgandaDistrictsImport, 'districts.csv');
    }
}
