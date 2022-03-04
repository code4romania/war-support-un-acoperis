<?php

use App\Http\Middleware\SetLocale;
use App\Http\Middleware\User\Administration;
use App\Http\Middleware\User\Host;
use App\Http\Middleware\User\Refugee;
use App\Http\Middleware\User\ShareMiddleware;
use App\Http\Middleware\User\Trusted;
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

Route::get('/', 'StaticPagesController@redirectToLocale');
Route::get('/health', 'HealthController@check')->name('health.check');

Route::get('/ad', function () {
    return redirect()->route('admin.dashboard');
})->name('admin.dashboard.proxy');

/**
 * Accommodation pictures
 */
Route::get('/media/accommodation/{accommodationId}/{identifier}.{extension}', 'MediaController@accommodationPhoto')
    ->where('accommodationId', '[0-9]+')
    ->name('media.accommodation-photo')
    ->middleware('auth');

/**
 * Administration routes
 */
Route::middleware([ShareMiddleware::class])->prefix('/share')->group(function (){
    Route::get('accommodation','ShareController@accommodationList')->name('share.accommodation.list');
    Route::get('accommodation/create','ShareController@accommodationCreate')->name('share.accommodation.create');
    Route::post('accommodation/store','ShareController@accommodationStore')->name('share.accommodation.store');
    Route::get('help-request','ShareController@helpRequestList')->name('share.help.request.list');
    Route::get('help-request/create','ShareController@helpRequestCreate')->name('share.help.request.create');
    Route::post('help-request/store','ShareController@helpRequestStore')->name('share.help.request.store');
    Route::delete('/ajax/help-request/{id}', 'AjaxController@deleteHelpRequestType')->name('ajax.delete-help-requests-type');
    Route::post('help-request/create-refugee','ShareController@createHelpRequestUser')->name('share.help.request.create.refugee');
    Route::get('help-request/{id}','ShareController@helpRequestDetail')->name('share.help.request.detail');
    Route::get('ajax/accommodations', 'AjaxController@accommodationList')->name('ajax.accommodation-list');
    Route::get('accommodation/{id}', 'Admin\AccommodationController@view')->name('admin.accommodation-detail');
});
Route::middleware([Administration::class])
    ->prefix('admin')
    ->group(function () {
        /**
         * Administrator routes
         */
        Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard')->middleware('2fa');

        Route::get('/users', 'Admin\UserController@index')->name('admin.user-list');
        Route::get('/user/add-trusted', 'Admin\UserController@addTrusted')->name('admin.trusted-user-add');
        Route::get('/user/add-admin', 'Admin\UserController@addAdministrator')->name('admin.admin-user-add');
        Route::post('/user/store-trusted-person', 'Admin\UserController@storeTrustedPerson')->name('admin.store-trusted-person');
        Route::post('/user/store-trusted-company', 'Admin\UserController@storeTrustedCompany')->name('admin.store-trusted-company');
        Route::post('/user/store-admin-person', 'Admin\UserController@storeAdminPerson')->name('admin.store-admin-person');
        Route::post('/user/store-admin-company', 'Admin\UserController@storeAdminCompany')->name('admin.store-admin-company');
        Route::get('/user/{id}', 'Admin\UserController@userDetail')->name('admin.user-detail');
        Route::get('/user/{id}/approve', 'Admin\UserController@approve')->name('admin.user-approve');
        Route::get('/user/{id}/reset-password', 'Admin\UserController@resetPassword')->name('admin.user-password-reset');


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

        Route::get('/help-request', 'Admin\HelpRequestController@helpList')->name('admin.help.request.list');
        Route::get('/help-request/{id}', 'Admin\HelpRequestController@helpDetail')->name('admin.help.request.detail');

        Route::get('/resources', 'Admin\ResourceController@resourceList')->name('admin.resource-list');
        Route::get('/resources/{id}/{page?}', 'Admin\ResourceController@resourceDetail')->name('admin.resource-detail');

        Route::get('/accommodation', 'Admin\AccommodationController@accommodationList')->name('admin.accommodation-list');
        Route::get('/accommodation/add/{userId}', 'Admin\AccommodationController@add')->name('admin.accommodation-add');
        Route::post('/accommodation/add/{userId}', 'Admin\AccommodationController@create')->name('admin.accommodation-create');
        Route::get('/accommodation/{id}/edit', 'Admin\AccommodationController@edit')->name('admin.accommodation-edit');
        Route::post('/accommodation/{id}/edit', 'Admin\AccommodationController@update')->name('admin.accommodation-update');
        Route::get('/accommodation/{id}/approve','Admin\AccommodationController@approve')->name('admin.accommodation-approve');
        Route::get('/accommodation/{id}/disapprove','Admin\AccommodationController@disapprove')->name('admin.accommodation-disapprove');

        Route::get('/host/detail/{id}/{page?}', 'Admin\HostController@detail')
            ->where('page', '[0-9]+')
            ->name('admin.host-detail');

        Route::get('/accommodation/{id}/delete', 'Admin\AccommodationController@delete')->name('admin.accommodation-delete');
        Route::post('/accommodation/{id}/allocate','Admin\AccommodationController@allocate')->name('admin.allocate.user.to.host');

        Route::get('/host/add', 'Admin\HostController@add')->name('admin.host-add');
        Route::post('/host/store-person', 'Admin\HostController@storePerson')->name('admin.store-host-person');
        Route::post('/host/store-company', 'Admin\HostController@storeCompany')->name('admin.store-host-company');
        Route::get('/host/edit/{id}', 'Admin\HostController@edit')->name('admin.host-edit');
        Route::post('/host/edit/{id}', 'Admin\HostController@update')->name('admin.host-update');
        Route::get('/host/{id}/delete', 'Admin\HostController@delete')->name('admin.host-delete');

        Route::get('/profile', 'Admin\ProfileController@profile')->name('admin.profile')->middleware('2fa');
        Route::get('/profile/edit', 'Admin\ProfileController@editProfile')->name('admin.edit-profile');
        Route::post('/profile/edit', 'Admin\ProfileController@saveProfile')->name('admin.save-profile');
        Route::get('/profile/reset-password', 'Admin\ProfileController@resetPassword')->name('admin.reset-password');
        Route::post('/profile/reset-password', 'Admin\ProfileController@saveResetPassword')->name('admin.save-reset-password');

        Route::get('/login-logs', 'Admin\LoginLogController@index')->name('admin.loginLogs.index');
        Route::get('/login-logs-search', 'Admin\LoginLogController@search')->name('admin.loginLogs.search');

        Route::get('/audit-logs', 'Admin\AuditLogController@index')->name('admin.auditLogs.index');
        Route::get('/audit-logs/{log}', 'Admin\AuditLogController@show')->name('admin.auditLogs.show');
        Route::get('/audit-logs-search', 'Admin\AuditLogController@search')->name('admin.auditLogs.search');




        /**
         * Ajax routes (admin)
         */
        Route::get('/ajax/help-requests', 'AjaxController@helpRequests')->name('ajax.help-requests');
        Route::put('/ajax/help-type/{id}', 'AjaxController@updateHelpRequestType')->name('ajax.update-help-requests-type');
        Route::post('/ajax/help-type/{id}/status', 'AjaxController@updateHelpRequestStatus')->name('ajax.update-help-requests-status');
        Route::delete('/ajax/help-request/{id}', 'AjaxController@deleteHelpRequestType')->name('ajax.delete-help-requests-type');
        Route::post('/ajax/note/{entityType}/{entityId}', 'AjaxController@createNote')->name('ajax.create-note');
        Route::put('/ajax/note/{id}', 'AjaxController@updateNote')->name('ajax.update-note');
        Route::delete('/ajax/note/{id}', 'AjaxController@deleteNote')->name('ajax.delete-note');
        Route::delete('/ajax/clinic/{id}', 'AjaxController@deleteClinic')->name('ajax.delete-clinic');
        Route::get('/ajax/resources', 'AjaxController@helpResources')->name('ajax.resources');
        Route::delete('/ajax/resources/{id}', 'AjaxController@deleteResource')->name('ajax.delete-request');

        Route::get('/ajax/accommodation/cities/{country?}', 'AjaxController@accommodationCityList')->name('ajax.accommodation-city-list');
        Route::delete('/ajax/accommodation/{id}', 'AjaxController@deleteAccommodation')->name('ajax.accommodation-delete');

        Route::delete('/ajax/accommodation/{id}/photo', 'AjaxController@deleteAccommodationPhoto')->name('ajax.admin-delete-accommodation-photo');
        Route::get('/ajax/dashboard/chart', 'AjaxController@chartData')->name('ajax.chart');

        Route::put('/ajax/bookAccommodation/{helpRequestAccommodationDetailId}/', 'AjaxController@bookAccommodation')->name('ajax.book-acc');
        Route::put('/ajax/unbookAccommodation/{helpRequestAccommodationDetailId}/', 'AjaxController@unbookAccommodation')->name('ajax.unbook-acc');

        Route::get('/ajax/accommodation/{id}/requests', 'AjaxController@accommodationRequestsList')->name('ajax.accommodation-requests');

        Route::get('/ajax/user-list', 'AjaxController@userList')->name('ajax.user-list');

    });

/**
 * Host routes
 */
Route::middleware([Host::class])
    ->prefix('host')
    ->group(function () {
        Route::get('/', 'Host\ProfileController@home')->name('host.home');
        Route::get('/profile', 'Host\ProfileController@profile')->name('host.profile')->middleware('2fa');
        Route::get('/profile/edit', 'Host\ProfileController@editProfile')->name('host.edit-profile');
        Route::post('/profile/edit', 'Host\ProfileController@saveProfile')->name('host.save-profile');
        Route::get('/profile/reset-password', 'Host\ProfileController@resetPassword')->name('host.reset-password');
        Route::post('/profile/reset-password', 'Host\ProfileController@saveResetPassword')->name('host.save-reset-password');

        Route::get('/accommodation/{page?}', 'Host\AccommodationController@accommodation')
            ->where('page', '[0-9]+')
            ->name('host.accommodation')
            ->middleware('2fa');
        Route::get('/accommodation/add', 'Host\AccommodationController@addAccommodation')->name('host.add-accommodation')->middleware('2fa');
        Route::post('/accommodation/add', 'Host\AccommodationController@createAccommodation')->name('host.create-accommodation');
        Route::get('/accommodation/{id}/view', 'Host\AccommodationController@viewAccommodation')->name('host.view-accommodation');
        Route::get('/accommodation/{id}/edit', 'Host\AccommodationController@editAccommodation')->name('host.edit-accommodation')->middleware('2fa');
        Route::post('/accommodation/{id}/edit', 'Host\AccommodationController@updateAccommodation')->name('host.update-accommodation');
        Route::get('/accommodation/{id}/delete', 'Host\AccommodationController@deleteAccommodation')->name('ajax.delete-accommodation');

        /**
         * Ajax routes (host)
         */
        Route::delete('/ajax/accommodation/{id}/photo', 'AjaxController@deleteAccommodationPhoto')->name('ajax.delete-accommodation-photo');
    });

Route::middleware([Trusted::class])
    ->prefix('trusted')
    ->group(function () {
        Route::get('/', 'Trusted\TrustedController@home')->name('trusted.home');
        Route::get('/profile', 'Host\ProfileController@profile')->name('trusted.profile')->middleware('2fa');
        Route::get('/profile/edit', 'Host\ProfileController@editProfile')->name('trusted.edit-profile');
        Route::post('/profile/edit', 'Host\ProfileController@saveProfile')->name('trusted.save-profile');
        Route::get('/profile/reset-password', 'Host\ProfileController@resetPassword')->name('trusted.reset-password');
        Route::post('/profile/reset-password', 'Host\ProfileController@saveResetPassword')->name('trusted.save-reset-password');
        Route::post('/add-user-person', 'Trusted\TrustedController@addPersonUser')->name('trusted.store-user-person');
        Route::post('/add-user-company', 'Trusted\TrustedController@addCompanyUser')->name('trusted.store-user-company');

        Route::get('/accommodation/{page?}', 'Host\AccommodationController@accommodation')
            ->where('page', '[0-9]+')
            ->name('trusted.accommodation')
            ->middleware('2fa');
        Route::get('/accommodation/add', 'Host\AccommodationController@addAccommodation')->name('trusted.add-accommodation')->middleware('2fa');
        Route::post('/accommodation/add', 'Host\AccommodationController@createAccommodation')->name('trusted.create-accommodation');
        Route::get('/accommodation/{id}/view', 'Host\AccommodationController@viewAccommodation')->name('trusted.view-accommodation');
        Route::get('/accommodation/{id}/edit', 'Host\AccommodationController@editAccommodation')->name('trusted.edit-accommodation')->middleware('2fa');
        Route::post('/accommodation/{id}/edit', 'Host\AccommodationController@updateAccommodation')->name('trusted.update-accommodation');
        Route::get('/accommodation/{id}/delete', 'Host\AccommodationController@deleteAccommodation')->name('ajax.delete-accommodation');

        /**
         * Ajax routes (host)
         */
        Route::delete('/ajax/accommodation/{id}/photo', 'AjaxController@deleteAccommodationPhoto')->name('ajax.delete-accommodation-photo');
        Route::get('/ajax/help-requests', 'AjaxController@helpRequests')->name('share.ajax.help-requests');
    });



Route::middleware([Refugee::class])
    ->prefix('refugee')
    ->group(function () {
        Route::get('/', 'Refugee\ProfileController@home')->name('refugee.home');
        Route::get('/profile', 'Refugee\ProfileController@profile')->name('refugee.profile');
        Route::get('/help-requests', 'Refugee\ProfileController@helpRequests')->name('refugee.help.requests');
        Route::get('/information', 'Refugee\ProfileController@information')->name('refugee.information');
        Route::get('/accommodation/{accommodation}/view', 'Refugee\ProfileController@viewAccommodation')->name('refugee.view-accommodation');
    });

/**
 * Ajax routes
 */
Route::post('/ajax/phone/check', 'AjaxController@checkPhone')->name('ajax.phone');
Route::get('/ajax/county/{regionId}/city', 'AjaxController@cities')->name('ajax.cities');

Route::get('/ajax/ua_region/{regionId}/city', 'AjaxController@uaCities')->name('ajax.cities');

Route::get('/ajax/clinics/{countyId}/cities', 'AjaxController@getClinicsCitiesByCountryId')->name('ajax.clinics-cities-by-country');
Route::get('/ajax/resources/{countyId}/cities', 'AjaxController@getResourcesCitiesByCountryId')->name('ajax.resources-cities-by-country');
Route::get('/ajax/clinics', 'AjaxController@clinicList')->name('ajax.clinic-list');


/**
 * 2FA
 */
Route::middleware(['throttle:60,1'])
    ->prefix('2fa')
    ->group(function () {
        Route::get('/', 'LoginSecurityController@show2faForm')->name('2fa.form')->middleware('verified', '2fa');
        Route::get('/check', 'LoginSecurityController@afterLoginCheck')->middleware(['verified', '2fa'])->name('2fa.login.check');
        Route::post('/generateSecret', 'LoginSecurityController@generate2faSecret')->name('generate2faSecret');
        Route::post('/enable2fa', 'LoginSecurityController@enable2fa')->name('enable2fa');
        Route::post('/disable2fa', 'LoginSecurityController@disable2fa')->name('disable2fa');

        // 2fa middleware
        Route::post('/verify', 'LoginSecurityController@verify')->name('2faVerify')->middleware('2fa');
    });

/**
 * Frontend routes
 */
Route::middleware([SetLocale::class])
    ->prefix('{locale?}')
    ->group(function () {
        Auth::routes(['verify' => true, 'register' => false]);

        /**
         * Header
         */
        Route::get('/', 'StaticPagesController@home')->name('home');
        Route::get('/request-help', 'RequestServicesController@index')->name('request-services');
        Route::post('/request-help-agreement', 'RequestServicesController@storeTermsAndConditionsAgreement')->name('request-services-submit-agreement');
        Route::post('/request-help-2', 'RequestServicesController@submitStep2')->name('request-services-submit-step2');
        Route::get('/request-help-3', 'RequestServicesController@requestHelpStep3')->name('request-services-step3');
        Route::post('/request-help-3', 'RequestServicesController@submitStep3')->name('request-services-submit-step3');
        Route::get('/request-help-thanks', 'RequestServicesController@thanks')->name('request-services-thanks');
        Route::get('/offer-help', 'GetInvolvedController@index')->name('get-involved');
        Route::get('/offer-help-confirmation', 'GetInvolvedController@confirmation')->name('get-involved-confirmation');
        Route::get('/host-signup-form', 'GetInvolvedController@displaySignupForm')->name('get-involved-display-signup-form');
        Route::get('/add-accommodation-form', 'GetInvolvedController@displayAccommodationForm')->name('get-involved-add-accommodation-form');
        Route::post('/save-accommodation', 'GetInvolvedController@saveAccommodation')->name('get-involved-save-accommodation');
        Route::get('/accommodation-saved', 'GetInvolvedController@accommodationSaved')->name('get-involved-success');
        Route::post('/store-hosts-terms-agreed', 'GetInvolvedController@storeTermsAndConditionsAgreement')->name('store-hosts-terms-agreed');
        Route::post('/create-host-person-account', 'GetInvolvedController@storePersonAccount')->name('create-host-person-account');
        Route::post('/create-host-company-account', 'GetInvolvedController@storeCompanyAccount')->name('create-host-company-account');
        Route::get('/clinics', 'ClinicController@index')->name('clinic-list');
        Route::get('/clinics/{clinic}', 'ClinicController@show')->name('clinic-details');
        Route::get('/contact', 'ContactController@contact')->name('contact');
        Route::post('/send-contact', 'ContactController@sendContact')->name('send-contact');
        Route::get('/contact-confirmation', 'ContactController@contactConfirmation')->name('contact-confirmation');
        Route::get('/newsletter', 'NewsletterController@newsletter')->name('newsletter');
        Route::get('/terms/refugee', 'StaticPagesController@refugeeTermsAndConditions')->name('terms-refugee');
        Route::get('/terms/host', 'StaticPagesController@hostTermsAndConditions')->name('terms-host');
        Route::get('/terms/trusted', 'StaticPagesController@trustedTermsAndConditions')->name('terms-trusted');
        Route::get('/{slug}', 'PageController@show')->name('static.pages');
    });
