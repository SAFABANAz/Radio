<?php

use Illuminate\Support\Facades\Route;

require base_path('Modules/Shared/Routes/web.php');

Route::get('/', function () {
    return view('landing.index');
});

Route::get('/ads/loadLoans', function () {
    return view('ads.ads');
});

