<?php

use App\Http\Controllers\MainPage\MainPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainPageController::class, 'index']);
