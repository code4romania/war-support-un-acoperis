<?php

namespace App\Http\Middleware;

use A17\Twill\Models\Block;
use App\Repositories\PageRepository;
use Closure;
use A17\Twill\Repositories\SettingRepository;
use Illuminate\Contracts\View\Factory as ViewFactory;

class ShareGlobalVariablesFromTwill
{
    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * @var PageRepository
     */
    private $pageRepository;

    /**
     * @var ViewFactory
     */
    private $view;

    /**
     * GlobalViewVariables constructor.
     * @param SettingRepository $settingRepository
     * @param PageRepository $pageRepository
     * @param ViewFactory $view
     */
    public function __construct(
        SettingRepository $settingRepository,
        PageRepository $pageRepository,
        ViewFactory $view
    ) {
        $this->settingRepository = $settingRepository;
        $this->pageRepository = $pageRepository;
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
        $headerItems = config('twill.navigations.header');

        $header = [];
        foreach ($headerItems as $headerId) {
            $header[] = $this->pageRepository->find($headerId);

        }

        $footerItems = config('twill.navigations.footer');
        $footer = [];
        foreach ($footerItems as $footerId) {
            $footer[] = $this->pageRepository->find($footerId);
        }

        $partnersBlock = Block::where('type', '=', 'homepage-partners')->first();

        $this->view->share('headerNavigation', $header);
        $this->view->share('footerNavigation', $footer);
        $this->view->share('partnersBlock', $partnersBlock);

        return $next($request);
    }
}
