<?php

use App\Http\Middleware\Administration;
use App\Http\Middleware\SetLanguage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/ro/homepage');

/**
 * Administration routes
 */
Route::middleware([SetLanguage::class, Administration::class])
    ->prefix('admin')
    ->group(function () {
        Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');
    });

/**
 * Ajax routes
 */
Route::get('/ajax/county/{countyId}/city', 'AjaxController@cities')->name('ajax.cities');

/**
 * Frontend routes
 */
Route::middleware([SetLanguage::class])
    ->prefix('{locale}')
    ->group(function () {
        Auth::routes(['verify' => true]);

        /**
         * Header
         */
        Route::get('/homepage', 'StaticPagesController@home')->name('home');
        Route::get('/about', 'StaticPagesController@about')->name('about');
        Route::get('/request-services', 'RequestServicesController@index')->name('request-services');
        Route::post('/request-services', 'RequestServicesController@submit')->name('request-services-submit');
        Route::get('/request-services-thanks', 'RequestServicesController@thanks')->name('request-services-thanks');
        Route::get('/get-involved', 'GetInvolvedController@index')->name('get-involved');
        Route::get('/clinic-list', 'ClinicController@index')->name('clinic-list');
        Route::get('/clinic/{slug}', 'ClinicController@show')->name('clinic-details');
        Route::get('/donate', 'DonateController@index')->name('donate');

        /**
         * Footer
         */
        Route::get('/partners', 'StaticPagesController@partners')->name('partners');
        Route::get('/media', 'StaticPagesController@media')->name('media');
        Route::get('/news', 'StaticPagesController@news')->name('news');
        Route::get('/privacy-policy', 'StaticPagesController@privacyPolicy')->name('privacy-policy');
        Route::get('/terms-and-conditions', 'StaticPagesController@termsAndConditions')->name('terms-and-conditions');
    });
