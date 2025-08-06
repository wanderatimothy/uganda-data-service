<?php

namespace App\Imports;

use App\Models\Country;
use App\Models\District;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UgandaDistrictsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows){

        $code = 'UG';

        $country = Country::where('code', $code)->first();

        $rows->each(function($row) use ($country){
            // dd($row);
             District::create([
                'districts_name' => $row['districtname'],
                'districts_code' => $row['districtcode'],
                'country_id' => $country->id,
                'is_verified' => now()
             ]);

        });

    }

    public function headingRow(){
        return 1;
    }
}
