<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

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

    public function upload(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'file' => ['required', 'file'],
            'path' => ['required', 'string'],
        ]);
        if(Storage::disk('c-drive')->exists($data['path'] . '/' . $data['file']->getClientOriginalName())){
            throw new \RuntimeException("Já existe arquivo com o nome \"{$data['file']->getClientOriginalName()}\" nesse local.");
        }
        Storage::disk('c-drive')->putFileAs(
            $data['path'],
            $data['file'],
            $data['file']->getClientOriginalName()
        );

        return back();
    }
}
