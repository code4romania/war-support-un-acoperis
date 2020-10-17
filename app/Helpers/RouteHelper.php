<?php

namespace App\Helpers;

use App\Models\Page;
use App\Repositories\PageRepository;

class RouteHelper
{
    public static function translateCurrentSlug(array $params): array
    {
        if (! isset($params['slug'])) {
            return $params;
        }

        if (! isset($params['locale'])) {
            return $params;
        }

        $locale = $params['locale'];
        $slug = $params['slug'];

        /**
         * @var PageRepository $pageRepository
         */
        $pageRepository = app()->make(PageRepository::class);

        /**
         * @var Page $item
         */
        $item = $pageRepository->forSlug($slug);

        if (empty($item)) {
            return $params;
        }

        $params['slug'] = $item->getSlug($locale);

        return $params;
    }
}
