<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\File;

class FileController extends Controller
{
    public function __construct(private File $file)
    {
    }

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
        try{
            $data = $request->validate([
                'file' => ['required', 'file'],
                'path' => ['required', 'string'],
            ]);

            $this->file->criar($data);

            return back();
        }catch(\RuntimeException $e){
            return back()->withErrors(['file' => $e->getMessage()]);
        }
    }
}
