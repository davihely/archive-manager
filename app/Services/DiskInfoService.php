<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class DiskInfoService
{
    public function getFreeDiskSize(): array
    {
        $disk = Storage::disk('c-drive')->path('');

        $freeSpace = disk_free_space($disk);
        $totalSpace = disk_total_space($disk);

        return [
            'freeSpace' => number_format($freeSpace / (1024 * 1024 * 1024), 2),
            'totalSpace' => number_format($totalSpace / (1024 * 1024 * 1024), 2),
        ];
    }
}
