<?php

// Route::get('/', function()
// {
//     return View::make('hello');
// });

Route::get('/', 'LandingController@index');


Route::get('about', function()
{
    return View::make('pages.about'); // return View('pages.about');
});

## Login & Register:
Route::get('login', 'UsersController@login');
Route::post('register', 'UsersController@register');
Route::post('login', 'UsersController@doLogin');
Route::get('logout', 'UsersController@logout');
Route::get('cas/login', 'UsersController@casLogin');
Route::get('users/sync', 'UsersController@sync');

Route::get('cms', 'UsersController@cms');

## Trainings:
Route::get('trainings', 'TrainingsController@index');
Route::get('trainings/create', 'TrainingsController@create');
Route::get('trainings/{id}/edit', 'TrainingsController@edit');
Route::post('trainings/{id}/update', 'TrainingsController@update');
Route::post('trainings', 'TrainingsController@store');

Route::get('trainings/{training_id}/delete', 'TrainingsController@destroy');
Route::get('trainings/{training_id}', 'TrainingsController@show');
Route::put('trainings', 'TrainingsController@update');

## Attend training:
Route::get('trainings_attendees', 'TrainingsAttendeesController@index');
Route::get('trainings_attendees/search', 'TrainingsAttendeesController@search');
Route::get('trainings_attendees/list', 'TrainingsAttendeesController@index');
Route::post('trainings/{training_id}/attendees', 'TrainingsAttendeesController@store');
Route::post('api/trainings/{training_id}/attendees', 'TrainingsAttendeesController@ajaxStore');  // This is for "news" page's ajax request
Route::post('trainings_attendees/search', 'TrainingsAttendeesController@doSearch');

Route::get('trainings_attendees/{id}/approve', 'TrainingsAttendeesController@approve');
Route::get('trainings_attendees/{id}/disapprove', 'TrainingsAttendeesController@disapprove');

## Search:
Route::get('search', 'SearchController@show');

## Locations:
Route::get('locations', 'LocationsController@index');
Route::get('locations/create', 'LocationsController@create');
Route::get('locations/{id}/edit', 'LocationsController@edit');
Route::post('locations/{id}/update', 'LocationsController@update');

Route::post('locations', 'LocationsController@store');
// Route::get('locations/{id}/create', 'LocationsController@create');
Route::post('locations/{id}/rent', 'LocationsController@rent');
Route::get('locations_rent/search', 'LocationsController@searchForm');
Route::post('locations_rent/search', 'LocationsController@search');

Route::get('locations_rent/audit', 'LocationsController@audit');
Route::get('locations_rent/{id}/approve', 'LocationsController@approve');
Route::get('locations_rent/{id}/disapprove', 'LocationsController@disapprove');

Route::get('locations/{id}', 'LocationsController@show');
Route::get('locations/{id}/delete', 'LocationsController@destroy');

## Articles:
Route::get('/news/{id}', 'NewsController@show');
Route::get('cms/news', 'NewsController@index');
Route::get('cms/news/create', 'NewsController@create');
Route::post('cms/news/create', 'NewsController@store');
Route::get('cms/news/{id}/edit', 'NewsController@edit');
Route::post('cms/news/{id}/update', 'NewsController@update');
Route::get('cms/news/{id}/delete', 'NewsController@destroy');

## Categories:
Route::get('/categories/{id}', 'CategoriesController@show');
Route::get('cms/categories', 'CategoriesController@index');
Route::get('cms/categories/create', 'CategoriesController@create');
Route::post('cms/categories', 'CategoriesController@store');
Route::get('cms/categories/{id}/edit', 'CategoriesController@edit');
Route::post('cms/categories/{id}/update', 'CategoriesController@update');
Route::get('cms/categories/{id}/delete', 'CategoriesController@destroy');

## Subcategories
Route::get('/categories/{category_id}/subcategories/{subcategory_id}', 'SubcategoriesController@show');
Route::get('cms/subcategories', 'SubcategoriesController@index');
Route::get('cms/subcategories/create', 'SubcategoriesController@create');
Route::post('cms/subcategories', 'SubcategoriesController@store');
Route::get('cms/subcategories/{id}/edit', 'SubcategoriesController@edit');
Route::post('cms/subcategories/{id}/update', 'SubcategoriesController@update');
Route::get('cms/subcategories/{id}/delete', 'SubcategoriesController@destroy');

Route::get('cms/password/edit', 'PasswordController@edit');
Route::post('cms/password/update', 'PasswordController@update');
Route::get('cms/users', 'UsersController@lists');
Route::any('cms/users/{id}/password/reset', 'PasswordController@reset');

## Friendly sites
Route::get('cms/friendly_sites', 'FriendlyController@indexFriendly');
Route::get('cms/friendly_sites/create', 'FriendlyController@createFriendly');
Route::post('cms/friendly_sites/store', 'FriendlyController@storeFriendly');
Route::get('cms/friendly_sites/{id}/edit', 'FriendlyController@editFriendly');
Route::post('cms/friendly_sites/{id}/update', 'FriendlyController@updateFriendly');
Route::get('cms/friendly_sites/{id}/delete', 'FriendlyController@deleteFriendly');

Route::get('cms/education_department', 'FriendlyController@indexEducation');
Route::get('cms/education_department/create', 'FriendlyController@createEducation');
Route::post('cms/education_department/store', 'FriendlyController@storeEducation');
Route::get('cms/education_department/{id}/edit', 'FriendlyController@editEducation');
Route::post('cms/education_department/{id}/update', 'FriendlyController@updateEducation');
Route::get('cms/education_department/{id}/delete', 'FriendlyController@deleteEducation');

## 留言管理
Route::post('messages', 'MessageController@store');
Route::get('messages', 'MessageController@index');
Route::get('cms/messages', 'MessageController@indexCMS');
Route::get('cms/messages/unreply', 'MessageController@indexCMSUnreply');
Route::get('cms/messages/{id}/edit', 'MessageController@edit');
Route::post('cms/messages/{id}/edit', 'MessageController@update');
Route::get('cms/messages/{id}/delete', 'MessageController@destroy');

## 问卷调查
Route::get('questionaires/{id}', 'QuestionairesController@show');
Route::get('cms/questionaires', 'QuestionairesController@index');
Route::get('cms/questionaires/create', 'QuestionairesController@create');
Route::post('cms/questionaires/create', 'QuestionairesController@store');
Route::post('questionaires/{questionaire_id}/vote', 'QuestionairesController@vote');
Route::get('cms/questionaires/{id}/delete', 'QuestionairesController@destroy');
Route::get('cms/questionaires/{id}/stats', 'QuestionairesController@stats');
Route::get('cms/questionaires/{id}/edit', 'QuestionairesController@edit');
Route::post('cms/questionaires/{id}/edit', 'QuestionairesController@update');
