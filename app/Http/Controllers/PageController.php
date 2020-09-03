<?php

namespace App\Http\Controllers;

use A17\Twill\Repositories\SettingRepository;
use App\Repositories\PageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PageController extends \A17\Twill\Http\Controllers\Front\Controller
{
    /**
     * @var PageRepository
     */
    private $pageRepository;

    /**
     * PageController constructor.
     * @param PageRepository $pageRepository
     */
    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
        parent::__construct();
    }

    public function index()
    {
        return view('site.pages', [
            'pages' => $this->pageRepository->listAll()
        ]);
    }

    public function show(string $slug)
    {
        $item = $this->pageRepository->forSlug($slug);
        if(empty($item)) {
            abort('404');
        }

        return view('site.page', compact('item'));
    }

    /**
     * @param string $method
     * @param array $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function callAction($method, $parameters)
    {
        unset($parameters['locale']);
        return parent::callAction($method, $parameters);
    }
}
