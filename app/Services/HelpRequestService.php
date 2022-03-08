<?php

namespace App\Services;

use App\HelpRequest;
use App\User;

class HelpRequestService
{
    public function create($data, $user = null, $createdBy = null)
    {
        $user = $user ?? auth()->user();

        $helpRequest = new HelpRequest();
        $helpRequest->user_id = $user->id;
        $helpRequest->current_location = $data['current_location'];
        $helpRequest->guests_number = $this->getGuestsNumber($data);
        $helpRequest->known_languages = json_encode($data['known_languages']);
        $helpRequest->special_needs = $data['special_request'] ?? null;
        $helpRequest->with_peoples = $this->getPersonInCareJson($data);
        $helpRequest->more_details = $data['more_details'] ?? "";
        $helpRequest->need_car = (bool)($data['need_transport'] ?? false);
        $helpRequest->need_special_transport = (bool)($data['need_special_transport'] ?? false);
        $helpRequest->status = HelpRequest::STATUS_NEW;
        $helpRequest->created_by = $createdBy->id ?? $user->id;
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
        $personsInCare = [];

        for ($index = 1; $index <= $data['person_in_care_count']; $index++) {
            $person = [
                'name' => $data['person_in_care_name'][$index] ?? null,
                'age' => $data['person_in_care_age'][$index] ?? null,
                'mentions' => $data['person_in_care_mentions'][$index] ?? null,
            ];

            // if no info for person, skip it
            if (count(array_filter($person)) == 0) {
                continue;
            }

            $personsInCare[] = $person;
        }

        return json_encode($personsInCare);
    }
}
