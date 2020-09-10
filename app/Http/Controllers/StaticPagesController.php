<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class StaticPagesController
 * @package App\Http\Controllers
 */
class StaticPagesController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function home(Request $request)
    {
        return view('frontend.home');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function about(Request $request)
    {
        return view('frontend.about');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function partners(Request $request)
    {
        return view('frontend.partners');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function media(Request $request)
    {
        return view('frontend.media');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function news(Request $request)
    {
        return view('frontend.news');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function privacyPolicy(Request $request)
    {
        return view('frontend.privacy-policy');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function termsAndConditions(Request $request)
    {
        return view('frontend.terms-and-conditions');
    }


    public function redirectToLocale()
    {
        $locale = app()->getLocale();
        return redirect()->route('home', ['locale' => $locale]);
    }

    public function gdpr()
    {
        return view('frontend.gdpr');
    }
}
