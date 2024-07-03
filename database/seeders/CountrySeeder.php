<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\City;
use App\Models\Country;
use App\Models\Hotel;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::factory(1)->create()->each(function($country) {
            $country->cities()->saveMany(City::factory(50)->make());
        });
    }
}