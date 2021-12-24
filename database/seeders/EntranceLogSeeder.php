<?php

namespace Database\Seeders;

use App\Models\EntranceLog;
use Illuminate\Database\Seeder;

class EntranceLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EntranceLog::factory(3)->create();
    }
}
