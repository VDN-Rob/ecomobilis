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

    Route::group(['middleware' => ['auth']], function () {

        Route::get('/carpool/add', 'CarpoolController@create')->name('carpoolCreate');
        Route::post('/carpool/store', 'CarpoolController@store')->name('carpoolStore');

        Route::get('/carpool/{id}/edit', 'CarpoolController@edit')->name('carpoolEdit');
        Route::put('/carpool/{id}/update', 'CarpoolController@update')->name('carpoolUpdate');

        Route::get('/carpool/{id}', 'CarpoolController@show')->name('carpoolShow');

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
    Route::get('/admin/carpool-as-passenger','CarpoolController@carpoolOverviewAsPassenger')->name('carpoolOverviewAsPassenger');

    Route::get('/admin/carpool-reservation/ride/{rideId}/user/{userId}/', 'CarpoolController@carpoolReservation')->name('carpoolReservation');
    Route::post('/admin/carpool-reservation/ride/{rideId}/user/{userId}/store', 'CarpoolController@carpoolReservationStore')->name('carpoolReservationStore');

    Route::get('/admin/carpool-messages/last-message', 'CarpoolMessagesController@lastMessage')->name('carpoolMessageslastMessage');
    Route::get('/admin/carpool-messages/ride/{rideId}/sender/{conversationPartnerId}/', 'CarpoolMessagesController@thread')->name('carpoolMessagesThread');

    Route::post('/admin/carpool-reservation/reservation/{rideReservationId}/confirm-reject-store', 'CarpoolController@carpoolReservationConfirmRejectStore')->name('carpoolReservationConfirmRejectStore');

    // user profile + user's car ----------
    Route::get('/admin/user/profile/{userId}/edit',   'UserController@profileEdit')->name('profileEdit');
    Route::put('/admin/user/profile/{userId}/update',   'UserController@profileUpdate')->name('profileUpdate');

    // groups
    Route::get('/admin/carpool-groups/',            'CarpoolGroupsController@overview')->name('carpoolGroupsOverview');

    Route::get('/admin/carpool-groups/add',         'CarpoolGroupsController@create')->name('carpoolGroupsCreate');
    Route::post('/admin/carpool-groups/store',      'CarpoolGroupsController@store')->name('carpoolGroupsStore');

    Route::get('/admin/carpool-groups/{id}/edit',         'CarpoolGroupsController@edit')->name('carpoolGroupsEdit');
    Route::put('/admin/carpool-groups/{id}/update',      'CarpoolGroupsController@update')->name('carpoolGroupsUpdate');


});

