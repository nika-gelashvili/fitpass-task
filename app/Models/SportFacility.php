<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportFacility extends Model
{
    protected $table = 'sport_facilities';
    use HasFactory, Uuids;

    /**
     * Get single random sport facility
     * @return mixed
     */
    public static function getRandom()
    {
        return self::inRandomOrder()->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function card()
    {
        return $this->hasMany(Card::class);
    }
}
