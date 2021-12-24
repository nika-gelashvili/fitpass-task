<?php

namespace Database\Factories;

use App\Models\SportFacility;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::getRandom();
        $sportFacilities = SportFacility::getRandom();
        return [
            'id' => $this->faker->uuid(),
            'user_id' => $user->id,
            'sport_facility_id' => $sportFacilities,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ];
    }
}
