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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('campaigns/{id}/settings', 'CampaignController@settings')->name('campaign_settings');
Route::get('campaigns/{id}/content', 'CampaignController@content')->name('campaign_content');

Route::get('ads/{id}/edit', 'AdController@edit')->name('ad_edit');


Route::get('sites/{id}/settings', 'SitesController@settings')->name('site_settings');
Route::get('sites/{id}/content', 'SitesController@content')->name('site_content');
Route::get('sites/{id}/targeting', 'SitesController@targeting')->name('site_targeting');

Route::resource('blocks', 'BlockController');
Route::resource('campaign_blocks', 'CampaignBlockController');
Route::resource('targetonly', 'TargetOnlyController');

Route::resource('campaigns', 'CampaignController');
Route::post('campaigns/{id}/ajax_enable', 'CampaignController@ajax_enable')->name('ajax_enable');
Route::post('campaigns/{id}/ajax_disable', 'CampaignController@ajax_disable')->name('ajax_disable');
Route::get('campaigns/{id}/targeting', 'CampaignController@targeting')->name('campaign_targeting');


Route::post('ads/{id}/ajax_enable', 'AdController@ajax_enable')->name('ajax_enable_ad');
Route::post('ads/{id}/ajax_disable', 'AdController@ajax_disable')->name('ajax_disable_ad');


Route::resource('adcampaigns3', 'Adcampaigns3Controller');

Route::resource('adcampaigns4', 'Adcampaigns4Controller');

Route::resource('sites', 'SitesController');

Route::get('ads/randomad', 'DisplayAdController@random')->name('random_ad');
Route::get('admin', 'AdminController@index')->name('admin');
Route::get('/admin/{id}/approve', 'AdminController@approve')->name('approve');
Route::get('/admin/{id}/deny', 'AdminController@deny')->name('deny');
Route::get('/admin/{id}/reset', 'AdminController@reset')->name('reset');


Route::get('/admin/{id}/approvesite', 'AdminController@approvesite')->name('approvesite');
Route::get('/admin/{id}/denysite', 'AdminController@denysite')->name('denysite');
Route::get('/admin/{id}/resetsite', 'AdminController@resetsite')->name('resetsite');


Route::get('ads/click', 'DisplayAdController@click')->name('click_ad');
Route::get('/refresh', 'RefreshController@index')->name('refresh');
Route::resource('ads', 'AdController');

Route::resource('widgets', 'WidgetController');
Route::get('/account', 'Account@index')->name('account');
Route::post('/charge', 'ChargeController@index')->name('charge');
Route::get('api/publisher_reports', 'APIController@publisher_report')->name('publisher_reports');

