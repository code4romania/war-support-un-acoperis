<?php

namespace App\Http\Controllers;

use A17\Twill\Models\Block;
use A17\Twill\Repositories\SettingRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 *
 * Class StaticPagesController
 * @package App\Http\Controllers
 */
class StaticPagesController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function home(Request $request, SettingRepository $settingRepository)
    {
        return view('frontend.home')
            ->with('welcomeTitle', $settingRepository->byKey('welcome_title'))
            ->with('welcomeBody', $settingRepository->byKey('welcome_body'))
            ->with('helpTitle', $settingRepository->byKey('help_title'))
            ->with('helpBlock1Title', $settingRepository->byKey('help_block_1_title'))
            ->with('helpBlock1Body', $settingRepository->byKey('help_block_1_body'))
            ->with('helpBlock2Title', $settingRepository->byKey('help_block_2_title'))
            ->with('helpBlock2Body', $settingRepository->byKey('help_block_2_body'))
            ->with('helpBlock3Title', $settingRepository->byKey('help_block_3_title'))
            ->with('helpBlock3Body', $settingRepository->byKey('help_block_3_body'))
            ->with('helpBlock4Title', $settingRepository->byKey('help_block_4_title'))
            ->with('helpBlock4Body', $settingRepository->byKey('help_block_4_body'))
            ->with('aboutTitle', $settingRepository->byKey('about_title'))
            ->with('aboutBody', $settingRepository->byKey('about_body'))
            ->with('askServicesTitle', $settingRepository->byKey('ask_services_title'))
            ->with('askServicesBody', $settingRepository->byKey('ask_services_body'))
            ->with('askServicesLink', $settingRepository->byKey('ask_services_link'))
            ->with('becomeHostTitle', $settingRepository->byKey('become_host_title'))
            ->with('becomeHostBody', $settingRepository->byKey('become_host_body'))
            ->with('footerBlock1Title', $settingRepository->byKey('footer_block_1_title'))
            ->with('footerBlock1Body', $settingRepository->byKey('footer_block_1_body'))
            ->with('footerBlock2Title', $settingRepository->byKey('footer_block_2_title'))
            ->with('footerBlock2Body', $settingRepository->byKey('footer_block_2_body'));
    }


    public function redirectToLocale()
    {
        $locale = app()->getLocale();
        return redirect()->route('home', ['locale' => $locale]);
    }
}
