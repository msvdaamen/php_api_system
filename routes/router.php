<?php
/**
 * Created by PhpStorm.
 * User: msvda
 * Date: 1-9-2018
 * Time: 14:29
 */

use App\Router\Route;

Route::get('/api/test', 'TestController@test');
Route::post('/api/test', 'TestController@test');
//Route::put('/api/test', 'TestController@test');
