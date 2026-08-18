<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DirectoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\EstruturaController;

Route::redirect('/', '/' . config('filesystems.start_path'));

Route::get('/arquivo/conteudo/{arquivo}', [FileController::class, 'conteudo'])
     ->where('arquivo', '.*')
     ->name('arquivo.conteudo');

Route::post('/arquivo/upload', [FileController::class, 'upload'])
    ->middleware('read-only.block')
    ->name('arquivo.upload');

Route::get('/download/{arquivo}', [FileController::class, 'download'])
     ->where('arquivo', '.*')
    ->name('arquivo.download');

Route::get('/arquivo/raw/{arquivo}', [FileController::class, 'raw'])
     ->where('arquivo', '.*')
     ->name('arquivo.raw');

Route::post('/estrutura', [EstruturaController::class, 'store'])
    ->middleware('read-only.block')
    ->name('estrutura.store');

Route::put('/estrutura', [EstruturaController::class, 'update'])
    ->middleware('read-only.block')
    ->name('estrutura.update');

Route::delete('/estrutura', [EstruturaController::class, 'destroy'])
    ->middleware('read-only.block')
    ->name('estrutura.destroy');

Route::get('/{folder}', [DirectoryController::class, 'index'])
    ->where('folder', '.*')
    ->name('index');