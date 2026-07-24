<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class DirectoryController extends Controller
{
    public function index($folder = null)
    {
        $files = Storage::disk('c-drive')->allFiles($folder);
        $items = [];

        foreach ($files as $filePath) {
            $relative = Str::after($filePath, $folder . '/');   
            $segments = explode('/', $relative);                
            $name = $segments[0];                               
            $type = count($segments) > 1 ? 'folder' : 'file';    

            if (!isset($items[$name])) {                        
                $items[$name] = [
                    'name' => $name,
                    'type' => $type,
                ];
            }
        }

        $currentDir = array_values($items);
        $urlPath = explode('/', request()->path());
        $breadCrumb = [];

        foreach ($urlPath as $index => $valor) {
            Arr::set($breadCrumb, "$index.label", $valor);
            Arr::set($breadCrumb, "$index.route", implode('/', array_slice($urlPath, 0, $index + 1)));
        }

        $directory = $this->sideMenu();

        return Inertia::render('Index', compact('currentDir', 'breadCrumb', 'directory'));
    }

    public function sideMenu()
    {
        $files = Storage::disk('c-drive')->allFiles('Temp');

        $tree = collect($files)->reduce(function ($carry, $filePath) {
            $segments = explode('/', $filePath);
            
            $current = &$carry;

            foreach ($segments as $index => $segment) {
                $isLast = ($index === count($segments) - 1);
                $type = $isLast ? 'file' : 'folder';

                if (!isset($current[$segment])) {
                    $current[$segment] = [
                        'name' => $segment,
                        'type' => $type,
                        'children' => []
                    ];
                }

                if ($type === 'folder') {
                    $current = &$current[$segment]['children'];
                }
            }

            return $carry;

        }, []); 

        $directory = $this->formatTreeValues($tree);

        return $directory;
    }

    private function formatTreeValues(array $tree): array
    {
        $formatted = array_values($tree);

        foreach ($formatted as &$node) {
            if (isset($node['children']) && !empty($node['children'])) {
                $node['children'] = $this->formatTreeValues($node['children']);
            }
        }

        return $formatted;
    }
}
