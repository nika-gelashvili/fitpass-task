<?php

namespace Database\Seeders;

use App\Models\SportFacility;
use Illuminate\Database\Seeder;

class SportFacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SportFacility::factory(6)->create();
    }
}
