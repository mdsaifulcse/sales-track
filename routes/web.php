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

Route::get('/','IndexController@login');
Route::get('/', function (){
    return redirect('/login');
});

Route::middleware(['auth','disablepreventback','admin'])->group(function () {

    // stuff area ======================================
    Route::get('/stuff-dashboard','StuffDashboardController@dashboardForStuff');
    Route::get('/goal-completion-data','StuffDashboardController@goalCompletion');
    Route::get('/load-target-year-data/{targetYear}','StuffDashboardController@getTargetYearDetails');

    Route::get('/show-my-daily-visit-data','StuffDashboardController@showMyAllVisitedList');//->middleware('permission:designation');
    Route::get('/show-my-follow-up-data','StuffDashboardController@showMyAllFollowUpData');//->middleware('permission:designation');

    Route::get('/daily-follow-up-details-modal/{followUpId}','StuffDashboardController@dailyFollowUpDetail');//->middleware('permission:designation');

    Route::get('/show-my-follow-up-modal/{id}','FollowUpController@showNewFollowUpForm');//->middleware('permission:designation');

    // pdf ---------------------------------------------
    Route::get('/my-follow-pdf/{followUpId}','StuffDashboardController@myFollowUpPdf');//->middleware('permission:designation');


    //  Super Admin area ================================
    Route::get('/dashboard', 'DashboadController@dashboard')->middleware('permission:dashboard');

    Route::get('/status-bar-data', 'DashboadController@getStatusBarData')->middleware('permission:dashboard');
    Route::get('/profit-chart-data', 'DashboadController@getProfitChartData')->middleware('permission:dashboard');

    Route::post('/set-commission-profit', 'DashboadController@setCommissionAndProfit')->middleware('permission:dashboard');

    Route::get('/load-commission-profit-data', 'DashboadController@filterCommissionProfit')->middleware('permission:dashboard');


    Route::get('/home', 'DashboadController@home');
    Route::get('/home/{slug}', 'DashboadController@subMenu');
    Route::get('/home/{slug}/{subslug}', 'DashboadController@subSubMenu');
    Route::get('/email-update-for-verify', 'Auth\VerificationController@updateEmail');

    // company visits ------------
    Route::resource('/company-visit','CompanyVisitController')->middleware('canAtLeast:company-visit.view,company-visit.edit,company-visit.create,company-visit.delete');
    Route::get('/show-company-visit-list','CompanyVisitController@showAllDailyReport');//->middleware('permission:designation');
    Route::get('/company-visit-details-modal/{id}','CompanyVisitController@companyVisitDetails');

    // company visits ------------
    Route::resource('/client-follow-up','FollowUpController')->middleware('canAtLeast:client-follow-up.view,client-follow-up.edit,client-follow-up.create,client-follow-up.delete');
    Route::get('/show-follow-up-data','FollowUpController@showAllFollowUpData');//->middleware('permission:designation');
    Route::get('/last-follow-up-details-modal/{followUpId}','FollowUpController@followUpDetails');//->middleware('permission:designation');

    Route::get('/lc-open-list','FollowUpController@lcOpenData')->middleware('permission:lc-open-list');
    Route::get('/show-all-lc-open-list','FollowUpController@showAlLlcOpenData')->middleware('permission:lc-open-list');



    Route::resource('/assign-target','AssignTargetController')->middleware('permission:assign-target');
    Route::resource('/business-year','BusinessYearController')->middleware('permission:business-year');
    Route::resource('/categories','CategoryController')->middleware('permission:designation');
    Route::resource('/designation','DesignationController')->middleware('permission:designation');

    // acl -----------------------------
    Route::resource('acl-role', 'AclRolesController')->middleware('permission:acl');
    Route::resource('acl-permission', 'AclPermissionController')->middleware('role:developer');
    Route::post('acl-permission-role', 'AclPermissionController@storeRole')->middleware('permission:acl');

    Route::resource('primary-info','PrimaryInfoController')->middleware('permission:primary-info');
    Route::resource('all-users','UsersController')->middleware('permission:users');

    Route::resource('user-profile','ProfileController');
    Route::post('change-password',[ 'as'=>'password','uses'=>'UsersController@password']);
    Route::get('change-password','UsersController@changePass')->middleware('permission:users');

    // menu setting --------------------
    Route::resource('menu','MenuController')->middleware('permission:menu');
    Route::resource('sub-menu','SubMenuController')->middleware('permission:menu');
    Route::resource('sub-sub-menu','SubSubMenuController')->middleware('permission:menu');
    Route::get('page-menu','MenuController@page')->middleware('permission:menu');
    Route::resource('pages','PagesController');
    Route::get('/logout','IndexController@logout');
});

Auth::routes(['register'=>false]);


