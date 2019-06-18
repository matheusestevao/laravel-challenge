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

$this->get('/home', 'HomeController@index')->name('home');

$this->group(['prefix' => 'admin'], function() {

    $this->get('/home', 'HomeController@index')->name('home');

    $this->group(['middleware' => 'auth'], function() {

        $this->group(['prefix' => 'events'], function() {

            $this->get('/', 'EventController@index')->name('event.index');
            $this->get('/create', 'EventController@create')->name('event.create');
            $this->post('/store', 'EventController@store')->name('event.store');
            $this->get('/edit/{id}', 'EventController@edit')->name('event.edit');
            $this->get('/show/{id}', 'EventController@show')->name('event.show');
            $this->post('/update/{id}', 'EventController@update')->name('event.update');
            $this->post('/delete/{id}', 'EventController@destroy')->name('event.delete');

        });

        $this->group(['prefix' => 'ajax'], function() {

            $this->get('/today', 'EventController@today')->name('ajax.today');
            $this->get('/next', 'EventController@next')->name('ajax.next');
            $this->get('/all', 'EventController@all')->name('ajax.all');

        });

    });

});
