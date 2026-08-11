<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileController extends Controller
{
    public function conteudo(string $arquivo): JsonResponse
    {
        $conteudo = Storage::disk('c-drive')->get($arquivo);

        return response()->json([
            'conteudo' => $conteudo,
        ]);
    }

    public function download(string $arquivo): StreamedResponse
    {
        if (Storage::disk('c-drive')->exists($arquivo)) {
            return Storage::disk('c-drive')->download($arquivo);
        }
    }

    public function raw(string $arquivo): StreamedResponse
    {
        return Storage::disk('c-drive')->response($arquivo);
    }
}
