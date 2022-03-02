<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleBlocks;
use A17\Twill\Repositories\Behaviors\HandleTranslations;
use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Page;

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
