<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'cards';
    use HasFactory, Uuids;

    /**
     * Function returns Card model selected by id with User and SportFacility models.
     * @param $id
     * @return mixed
     */
    public static function getByIdWithUserAndFacility($id)
    {
        return self::where('id', $id)
            ->with('user', 'facility')
            ->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function facility()
    {
        return $this->belongsTo(SportFacility::class, 'sport_facility_id', 'id');
    }
}
