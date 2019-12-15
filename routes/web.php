<?php

Route::get('/', 'WeatherController@index');
Route::get('/getweather/{id}', 'WeatherController@getweather');
