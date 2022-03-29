<?php

namespace App\Http\Middleware;

use A17\Twill\Models\Block;
use App\Models\Page;
use Closure;
use Illuminate\Contracts\View\Factory as ViewFactory;

class ShareGlobalVariablesFromTwill
{
    /**
     * @var ViewFactory
     */
    private $view;

    /**
     * GlobalViewVariables constructor.
     * @param ViewFactory $view
     */
    public function __construct(ViewFactory $view) {
        $this->view = $view;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->view->share([
            'headerNavigation' => Page::findMany(
                array_values(config('twill.navigations.header'))
            ),
            'footerNavigation' => Page::findMany(
                array_values(config('twill.navigations.footer'))
            ),
            'partnersBlock' => Block::firstWhere('type', 'homepage-partners'),
        ]);

        return $next($request);
    }
}
