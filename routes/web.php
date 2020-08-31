<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
Route::get('scraping','ScrapingController@main');
Route::get('scraping/detail','ScrapingController@detail');
