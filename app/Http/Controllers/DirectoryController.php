<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use App\Services\DiskInfoService;

class DirectoryController extends Controller
{
    public function __construct(private DiskInfoService $diskInfoService)
    {
    }

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
        $disk = $this->diskInfoService->getFreeDiskSize();

        return Inertia::render('Index', compact('currentDir', 'breadCrumb', 'directory', 'disk'));
    }

    public function sideMenu()
    {
        return $this->buildTree('Temp');
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
