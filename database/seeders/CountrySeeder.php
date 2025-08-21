<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data/countries_ar.json'));
        $countries = json_decode($json, true);

        foreach ($countries as $country) {
            Country::updateOrCreate(
                ['code' => $country['code']],
                ['name_ar' => $country['name_ar']] ,
                ['phone_code' => $country['phone_code']]
            );
        }
    }
}
