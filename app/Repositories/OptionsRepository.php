<?php

namespace App\Repositories;

class OptionsRepository
{
    public function getInstitutionTypes()
    {
        return [
            'public_institution' => __("Public institution option"),
            'ngo' => __("NGO option"),
        ];
    }

    public function getSupportTypes()
    {
        return [
            'request_housing_for_refugees' => __("Request housing for refugees"),
            'offer_housing' => __("Offer housing"),
        ];
    }
}
