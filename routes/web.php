<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DirectoryController;

Route::redirect('/', '/Temp');

Route::get('/{folder}', [DirectoryController::class, 'index'])
    ->where('folder', '.*')
    ->name('index');