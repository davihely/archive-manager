<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DirectoryController extends Controller
{
    public function index($folder = null)
    {
        $folder = $folder ?? '';
        $disk = Storage::disk('c-drive');
        $items = [];

        foreach ($disk->directories($folder) as $path) {
            $items[] = ['name' => basename($path), 'type' => 'folder'];
        }

        foreach ($disk->files($folder) as $path) {
            $items[] = ['name' => basename($path), 'type' => 'file'];
        }

        $currentDir = $items;
        $urlPath = explode('/', request()->path());
        $breadCrumb = [];

        foreach ($urlPath as $index => $valor) {
            Arr::set($breadCrumb, "$index.label", $valor);
            Arr::set($breadCrumb, "$index.route", implode('/', array_slice($urlPath, 0, $index + 1)));
        }

        $directory = $this->sideMenu();
        $disk = $this->getFreeDiskSize();

        return Inertia::render('Index', compact('currentDir', 'breadCrumb', 'directory', 'disk'));
    }

    public function sideMenu()
    {
        return $this->buildTree('Temp');
    }

    public function getArquivoConteudo(string $arquivo): JsonResponse{
        $conteudo = Storage::disk('c-drive')->get($arquivo);
        return response()->json([
            'conteudo' => $conteudo
        ]);
    }

    public function downloadArquivo(string $arquivo): StreamedResponse{
        if(Storage::disk('c-drive')->exists($arquivo)){
            return Storage::disk('c-drive')->download($arquivo);
        }
    }

    public function getFreeDiskSize(){
        $disk = Storage::disk('c-drive')->path('');

        $freeSpace = disk_free_space($disk);
        $totalSpace = disk_total_space($disk);

        $freeSpaceGB = number_format($freeSpace / (1024 * 1024 * 1024), 2);
        $totalSpaceGB = number_format($totalSpace / (1024 * 1024 * 1024), 2);

        $diskData = [
            'freeSpace' => $freeSpaceGB,
            'totalSpace' => $totalSpaceGB
        ];

        return $diskData;
    }

    public function arquivoRaw(string $arquivo): StreamedResponse{
        return Storage::disk('c-drive')->response($arquivo);
    }

    private function buildTree(string $path): array
    {
        $disk = Storage::disk('c-drive');
        $tree = [];

        foreach ($disk->directories($path) as $dirPath) {
            $tree[] = [
                'name' => basename($dirPath),
                'type' => 'folder',
                'children' => $this->buildTree($dirPath),
            ];
        }

        foreach ($disk->files($path) as $filePath) {
            $tree[] = [
                'name' => basename($filePath),
                'type' => 'file',
            ];
        }

        return $tree;
    }
}
