<?php

use App\Http\Middleware\Administration;
use App\Http\Middleware\Host;
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

Route::redirect('/', '/ro');
Route::get('/health', 'HealthController@check')->name('health.check');

/**
 * Administration routes
 */
Route::middleware([SetLanguage::class, Administration::class])
    ->prefix('admin')
    ->group(function () {
        /**
         * Administrator routes
         */
        Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');

        Route::get('/clinic', 'Admin\ClinicController@clinicList')->name('admin.clinic-list');
        Route::get('/clinic/add', 'Admin\ClinicController@clinicAdd')->name('admin.clinic-add');
        Route::post('/clinic/add', 'Admin\ClinicController@clinicCreate')->name('admin.clinic-create');
        Route::get('/clinic/edit/{id}', 'Admin\ClinicController@clinicEdit')->name('admin.clinic-edit');
        Route::post('/clinic/edit/{id}', 'Admin\ClinicController@clinicUpdate')->name('admin.clinic-update');

        Route::get('/clinic/categories', 'Admin\ClinicController@clinicCategoryList')->name('admin.clinic-category-list');
        Route::get('/clinic/category/add/{parent?}', 'Admin\ClinicController@clinicCategoryAdd')->name('admin.clinic-category-add');
        Route::post('/clinic/category/add/{parent?}', 'Admin\ClinicController@clinicCategoryCreate')->name('admin.clinic-category-create');
        Route::get('/clinic/category/{id}', 'Admin\ClinicController@clinicCategoryEdit')->name('admin.clinic-category-edit');
        Route::post('/clinic/category/{id}', 'Admin\ClinicController@clinicCategoryUpdate')->name('admin.clinic-category-update');
        Route::get('/clinic/category/delete/{id}', 'Admin\ClinicController@clinicCategoryDelete')->name('admin.clinic-category-delete');
        Route::get('/clinic/{id}', 'Admin\ClinicController@clinicDetail')->name('admin-clinic-detail');

        Route::get('/help', 'Admin\HelpRequestController@helpList')->name('admin.help-list');
        Route::get('/help/{id}', 'Admin\HelpRequestController@helpDetail')->name('admin.help-detail');

        Route::get('/resources', 'Admin\ResourceController@resourceList')->name('admin.resource-list');
        Route::get('/resources/{id}', 'Admin\ResourceController@resourceDetail')->name('admin.resource-detail');

        Route::get('/accommodation', 'Admin\AccommodationController@accommodationList')->name('admin.accommodation-list');
        Route::get('/accommodation/{id}', 'Admin\AccommodationController@view')->name('admin.accommodation-detail');

        Route::get('/host/add', 'Admin\HostController@add')->name('admin.host-add');
        Route::post('/host/store', 'Admin\HostController@store')->name('admin.host-store');
        Route::get('/host/detail', 'Admin\HostController@detail')->name('admin.host-detail');


        /**
         * Ajax routes (admin)
         */
        Route::get('/ajax/help-requests', 'AjaxController@helpRequests')->name('ajax.help-requests');
        Route::put('/ajax/help-type/{id}', 'AjaxController@updateHelpRequestType')->name('ajax.update-help-requests-type');
        Route::delete('/ajax/help-request/{id}', 'AjaxController@deleteHelpRequestType')->name('ajax.delete-help-requests-type');
        Route::post('/ajax/note/{entityType}/{entityId}', 'AjaxController@createNote')->name('ajax.create-note');
        Route::put('/ajax/note/{id}', 'AjaxController@updateNote')->name('ajax.update-note');
        Route::delete('/ajax/note/{id}', 'AjaxController@deleteNote')->name('ajax.delete-note');
        Route::delete('/ajax/clinic/{id}', 'AjaxController@deleteClinic')->name('ajax.delete-clinic');
        Route::get('/ajax/resources', 'AjaxController@helpResources')->name('ajax.resources');
        Route::delete('/ajax/resources/{id}', 'AjaxController@deleteResource')->name('ajax.delete-request');

        Route::get('/ajax/accommodations', 'AjaxController@accommodationList')->name('ajax.accommodation-list');
        Route::delete('/ajax/accommodation/{id}', 'AjaxController@deleteAccommodation')->name('ajax.accommodation-delete');
    });

/**
 * Host routes
 */
Route::middleware([SetLanguage::class, Host::class])
    ->prefix('host')
    ->group(function () {
        Route::get('/profile', 'Host\ProfileController@profile')->name('host.profile');
        Route::get('/profile/edit', 'Host\ProfileController@editProfile')->name('host.edit-profile');
        Route::post('/profile/edit', 'Host\ProfileController@saveProfile')->name('host.save-profile');
        Route::get('/profile/reset-password', 'Host\ProfileController@resetPassword')->name('host.reset-password');
        Route::post('/profile/reset-password', 'Host\ProfileController@saveResetPassword')->name('host.save-reset-password');

        Route::get('/accommodation/{page?}', 'Host\AccommodationController@accommodation')
            ->where('page', '[0-9]+')
            ->name('host.accommodation');
        Route::get('/accommodation/add', 'Host\AccommodationController@addAccommodation')->name('host.add-accommodation');
        Route::post('/accommodation/add', 'Host\AccommodationController@createAccommodation')->name('host.create-accommodation');
        Route::get('/accommodation/{id}/view', 'Host\AccommodationController@viewAccommodation')->name('host.view-accommodation');
        Route::get('/accommodation/{id}/edit', 'Host\AccommodationController@editAccommodation')->name('host.edit-accommodation');
        Route::post('/accommodation/{id}/edit', 'Host\AccommodationController@updateAccommodation')->name('host.update-accommodation');
        Route::get('/accommodation/{id}/delete', 'Host\AccommodationController@deleteAccommodation')->name('ajax.delete-accommodation');

        /**
         * Ajax routes (host)
         */
        Route::delete('/ajax/accommodation/{id}/photo', 'AjaxController@deleteAccommodationPhoto')->name('ajax.delete-accommodation-photo');

    });

/**
 * Ajax routes
 */
Route::get('/ajax/county/{countyId}/city', 'AjaxController@cities')->name('ajax.cities');
Route::get('/ajax/clinics/{countyId}/cities', 'AjaxController@getClinicsCitiesByCountryId')->name('ajax.clinics-cities-by-country');
Route::get('/ajax/resources/{countyId}/cities', 'AjaxController@getResourcesCitiesByCountryId')->name('ajax.resources-cities-by-country');
Route::get('/ajax/clinics', 'AjaxController@clinicList')->name('ajax.clinic-list');

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
        Route::get('/', 'StaticPagesController@home')->name('home');
        Route::get('/about', 'StaticPagesController@about')->name('about');
        Route::get('/request-services', 'RequestServicesController@index')->name('request-services');
        Route::post('/request-services', 'RequestServicesController@submit')->name('request-services-submit');
        Route::get('/request-services-thanks', 'RequestServicesController@thanks')->name('request-services-thanks');
        Route::get('/get-involved', 'GetInvolvedController@index')->name('get-involved');
        Route::get('/get-involved-confirmation', 'GetInvolvedController@confirmation')->name('get-involved-confirmation');
        Route::post('/store-get-involved', 'GetInvolvedController@store')->name('store-get-involved');
        Route::get('/clinics', 'ClinicController@index')->name('clinic-list');
        Route::get('/clinics/{clinic}', 'ClinicController@show')->name('clinic-details');
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
