<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group([], function() {

    Auth::routes();

});


Auth::routes();


Route::group(['namespace' => 'App\Http\Controllers\Web', 'as' => 'web.'], function () {

    // general
    Route::get('/',         'PagesController@index')->name('index');
    Route::get('/about-us', 'PagesController@aboutUs')->name('aboutUs');


    // carpool ----------
    Route::get('/carpool/', 'CarpoolController@overview')->name('carpoolOverview');

    Route::post('/carpool/matching', 'CarpoolController@matching')->name('carpoolMatching');

    // car and bike sharing ----------
    Route::get('/sharing',      'SharingController@index')->name('sharingOverview');
    Route::get('/sharing/{slug}', 'SharingController@show')->name('sharingShow');

    Route::get('/sharing-questionnaire', 'SharingQuestionnaireController@index')->name('questionnaire.index');
    Route::post('/sharing-questionnaire/answer', 'SharingQuestionnaireController@answer')->name('questionnaire.answer');

    //traffic ----------
    Route::get('/traffic', 'TrafficController@index')->name('trafficOverview');

    Route::group(['middleware' => ['auth']], function () {

        Route::get('/carpool/add', 'CarpoolController@create')->name('carpoolCreate');
        Route::post('/carpool/store', 'CarpoolController@store')->name('carpoolStore');

        Route::get('/carpool/{id}/edit', 'CarpoolController@edit')->name('carpoolEdit');
        Route::put('/carpool/{id}/update', 'CarpoolController@update')->name('carpoolUpdate');

        Route::get('/carpool/{id}', 'CarpoolController@show')->name('carpoolShow');
        Route::post('/carpool-cancel/{id}', 'CarpoolController@cancelRide')->name('carpoolCancel');

    });

    // users ----------
    Route::get('/user/profile/{userId}',        'UserController@profileShow')->name('profileShow');

    // faq ----------
    Route::get('/faq',        'FaqController@overview')->name('overviewFaq');

    // pages (via admin) ----------
    Route::get('/page/{page}',        'PagesController@page')->name('page');

    // overview ----------
    Route::get('/blog',        'BlogController@overview')->name('overviewBlog');
    Route::get('/blog/{slug}', 'BlogController@article')->name('articleBlog');


});

// groups - special auth
Route::group(['namespace' => 'App\Http\Controllers\Web', 'middleware' => ['authgroup'], 'as' => 'web.'], function () {

    Route::get('/group/{token}',        'CarpoolGroupsController@detail')->name('carpoolGroupsDetail');

});

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['auth'], 'as' => 'admin.'], function () {

    // carpool basics ----------
    Route::get('/admin/',                   'CarpoolController@overview')->name('carpoolOverview');
    Route::get('/admin/carpool/{filter}',         'CarpoolController@overview')->name('carpoolOverviewFilter');

    Route::get('/admin/carpool-as-passenger','CarpoolController@carpoolOverviewAsPassenger')->name('carpoolOverviewAsPassenger');

    Route::get('/admin/carpool-reservation/ride/{rideId}', 'CarpoolController@carpoolReservation')->name('carpoolReservation');
    Route::post('/admin/carpool-reservation/ride/{rideId}', 'CarpoolController@carpoolReservationStore')->name('carpoolReservationStore');

    Route::get('/admin/carpool-messages/last-message', 'CarpoolMessagesController@lastMessage')->name('carpoolMessageslastMessage');
    Route::get('/admin/carpool-messages/ride/{rideId}/sender/{conversationPartnerId}/', 'CarpoolMessagesController@thread')->name('carpoolMessagesThread');

    Route::post('/admin/carpool-reservation/reservation/{rideReservationId}/confirm-reject-store', 'CarpoolController@carpoolReservationConfirmRejectStore')->name('carpoolReservationConfirmRejectStore');
    Route::post('/admin/carpool-reservation/cancel/{rideReservationId}/confirm-reject-store', 'CarpoolController@carpoolReservationCancelStore')->name('carpoolReservationCancelStore');

    // user profile + user's car ----------
    Route::get('/admin/user/profile/edit',   'UserController@profileEdit')->name('profileEdit');
    Route::put('/admin/user/profile/update',   'UserController@profileUpdate')->name('profileUpdate');

    Route::get('/admin/user/delete/',       'UserController@profileDelete')->name('profileDelete');
    Route::delete('/admin/user/delete/',    'UserController@profileDestroy')->name('profileDestroy');

    // groups
    Route::get('/admin/carpool-groups/',            'CarpoolGroupsController@overview')->name('carpoolGroupsOverview');

    Route::get('/admin/carpool-groups/add',         'CarpoolGroupsController@create')->name('carpoolGroupsCreate');
    Route::post('/admin/carpool-groups/store',      'CarpoolGroupsController@store')->name('carpoolGroupsStore');

    Route::get('/admin/carpool-groups/{id}/edit',         'CarpoolGroupsController@edit')->name('carpoolGroupsEdit');
    Route::put('/admin/carpool-groups/{id}/update',      'CarpoolGroupsController@update')->name('carpoolGroupsUpdate');

    Route::get('/admin/carpool-groups/{id}/delete',      'CarpoolGroupsController@delete')->name('carpoolGroupsDelete');
    Route::delete('/admin/carpool-groups/{id}/delete',      'CarpoolGroupsController@destroy')->name('carpoolGroupsDestroy');

    Route::get('/admin/carpool-groups/{id}/archive',      'CarpoolGroupsController@archive')->name('carpoolGroupsArchive');
    Route::get('/admin/carpool-groups/{id}/unarchive',      'CarpoolGroupsController@unarchive')->name('carpoolGroupsUnarchive');

});
