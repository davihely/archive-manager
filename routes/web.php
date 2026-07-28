<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DirectoryController;

Route::redirect('/', '/Temp');

Route::get('/arquivo/conteudo/{arquivo}', [DirectoryController::class, 'getArquivoConteudo'])
     ->where('arquivo', '.*')
     ->name('arquivo.conteudo');

Route::get('/download/{arquivo}', [DirectoryController::class, 'downloadArquivo'])
     ->where('arquivo', '.*')
    ->name('arquivo.download');

Route::get('/arquivo/raw/{arquivo}', [DirectoryController::class, 'arquivoRaw'])
     ->where('arquivo', '.*')
     ->name('arquivo.raw');

Route::get('/{folder}', [DirectoryController::class, 'index'])
    ->where('folder', '.*')
    ->name('index');