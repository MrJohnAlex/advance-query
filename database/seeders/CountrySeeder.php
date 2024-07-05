<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\City;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create countries
        Country::factory(1)->create()->each(function ($country) {
            // Create cities for each country
            $cities = City::factory(50)->make();
            $country->cities()->saveMany($cities);
        });
    }
}