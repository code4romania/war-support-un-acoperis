<?php

namespace App\Services;

use App\HelpRequest;

class HelpRequestService
{
    public function create($data)
    {
        $helpRequest = new HelpRequest();
        $helpRequest->user_id = auth()->user()->id;
        $helpRequest->current_location = $data['current_location'];
        $helpRequest->guests_number = $this->getGuestsNumber($data);
        $helpRequest->known_languages = json_encode($data['known_languages']);
        $helpRequest->special_needs = $data['special_needs'] ?? null;
        $helpRequest->with_peoples = $this->getPersonInCareJson($data);
        $helpRequest->more_details = $data['more_details'] ?? "";
        $helpRequest->need_car = $data['need_transport'] ?? false;
        $helpRequest->need_special_transport = $data['need_special_transport'] ?? false;
        $helpRequest->save();
        return $helpRequest;
    }

    private function getGuestsNumber($data): int
    {
        if (empty($data['has_dependants_family'])) {
            return 1;
        }

        return 1 + (int)$data['person_in_care_count'];

    }

    private function getPersonInCareJson($data): string
    {
        $temp = [];
        for ($index = 0; $index < $data['person_in_care_count']; $index++) {
            $temp[] = [
                'name' => $data['person_in_care_name'][$index] ?? null,
                'age' => $data['person_in_care_age'][$index] ?? null,
                'mentions' => $data['person_in_care_mentions'][$index] ?? null,
            ];
        }
        return json_encode($temp);
    }

}
