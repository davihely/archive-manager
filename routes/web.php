<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DirectoryController;

Route::get('/', [DirectoryController::class, 'index'])->name('index');