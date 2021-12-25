<?php

namespace App\Models;

use App\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntranceLog extends Model
{
    use HasFactory, Uuids;

    /**
     * Function checks if there are any entrance logs for today by $userId and $facilityId
     * @param $userId
     * @param $facilityId
     * @return mixed
     */
    public static function checkUserHasEnteredFacility($userId, $facilityId)
    {
        return self::where('user_id', $userId)
            ->where('sport_facility_id', $facilityId)
            ->whereDate('created_at', '=', Carbon::today()->toDateString())
            ->first();
    }

    /**
     * Function saves entrance logs
     * @param $userId
     * @param $facilityId
     * @return bool
     */
    public static function saveEntrance($userId, $facilityId)
    {
        $entranceLog = new EntranceLog();
        $entranceLog->user_id = $userId;
        $entranceLog->sport_facility_id = $facilityId;
        $entranceLog->created_at = Carbon::today()->toDateString();
        return $entranceLog->save();
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
