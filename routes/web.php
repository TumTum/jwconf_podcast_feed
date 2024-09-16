<?php

use App\Http\Controllers\FeedController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/feed.xml', [FeedController::class, 'feed']);

Route::permanentRedirect('/feed.php', '/feed.xml'); //Fallback
