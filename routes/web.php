<?php

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

Route::get('/', function () {
    return 'Home';
});

Route::group(['namespace'=>'Admin'], function (){
    Route::get('second', 'SecondController@showString');
});

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/landing', function () {
    return view('landing');
})->name('land');

Auth::routes(['verify'=>true]);

Route::get('fillable','crudController@getOffers');

Route::group(['prefix'=>LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function (){

    Route::group(['prefix' => 'offers'], function() {
        Route::get('creat', 'CrudController@creat');
        Route::get('all', 'CrudController@getOffers')->name('offers.all');

        Route::get('edit/{offer_id}', 'CrudController@editOffer');
        Route::post('update/{offer_id}', 'CrudController@updateOffer')-> name('offers.update');
        Route::get('delete/{offer_id}', 'CrudController@delete')-> name('offers.delete');

        Route::post('store', 'CrudController@store')-> name('offers.store');
    });
    Route::get('youtube', 'CrudController@getVideo') ->middleware('auth');

});

/////////////////////////////////////ajax rout


Route::group(['prefix'=>'ajax-offers'],function (){
    Route::get('creat','OfferController@create');
    Route::get('all','OfferController@all')->name('ajax.offers.all');
    Route::post('store','OfferController@store')->name('ajax.offers.store');
    Route::post('delete','OfferController@delete')->name('ajax.offers.delete');
    Route::get('edit/{offer_id}','OfferController@edit')-> name('ajax.offers.edit');
    Route::post('update','OfferController@Update')->name('ajax.offers.update');

});



###########################start Authentication code #######################
Route::group(['middleware'=>'checkAge', 'namespace'=>'Auth'],function () {
    Route::get('adults', 'customAuthController@adult')->name('adult');

    Route::get('site', 'customAuthController@site')->middleware('auth:web')->name('site');
    Route::get('admin', 'customAuthController@admin')->middleware('auth:admin')->name('admin');

    Route::get('admin/login', 'customAuthController@adminLogin')->name('admin.login');
    Route::post('admin/login', 'customAuthController@checkAdminLogin')->name('save.admin.login');
});


###########################end Authentication code #######################











