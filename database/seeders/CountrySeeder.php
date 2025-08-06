<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =  Storage::get('countries.json');
        $data = json_decode($data,true);
        $data = array_map(function($item){
            return [
                "name" => $item['name'],
                "code" => $item['code'],
                'created_at' => now()->format('Y-m-d h:i:s'),
                'updated_at' => now()->format('Y-m-d h:i:s')
            ];
        },$data);
        DB::table('countries')
        ->insert($data);
    }
}
