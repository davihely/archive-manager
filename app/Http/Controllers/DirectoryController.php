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

        $directory = collect($files)->reduce(function ($carry, $filePath) {
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

        return Inertia::render('Index', compact('directory'));
    }
}
