<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\EntranceLog;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    use ApiResponser;

    /**
     * This endpoint checks if user can enter facility.
     * Request should have object_uuid sport_facilities uuid and card_uuid cards uuid.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function checkCanEnterFacility(Request $request)
    {
        $this->validate($request, [
            'object_uuid' => 'required|alpha_dash|exists:sport_facilities,id',
            'card_uuid' => 'required|alpha_dash|exists:cards,id'
        ]);

        $cardWithUserAndFacility = Card::getByIdWithUserAndFacility($request->card_uuid);

        $user = $cardWithUserAndFacility->user;
        $facility = $cardWithUserAndFacility->facility;

        if (!$user) {
            return $this->errorResponse(['status' => 'error', 'message' => 'No user associated with card found']);
        }

        if (!$facility) {
            return $this->errorResponse(['status' => 'error', 'message' => 'No facility associated with card found']);
        }

        $userHasEntranceLog = EntranceLog::checkUserHasEnteredFacility($user->id, $request->object_uuid);

        if ($userHasEntranceLog) {
            return $this->errorResponse(['status' => 'error', 'message' => 'User associated with card has already entered facility']);
        }

        if (!EntranceLog::saveEntrance($user->id, $request->object_uuid)) {
            return $this->errorResponse(['status' => 'error', 'message' => 'Error when saving entrance'], 500);
        }
        return $this->successResponse(['status' => 'OK', 'object_name' => $facility->name, 'first_name' => $user->name, 'last_name' => $user->last_name]);
    }
}
