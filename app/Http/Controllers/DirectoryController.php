<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DirectoryController extends Controller
{
    public function index()
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

        return Inertia::render('Index', compact('directory'));
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
