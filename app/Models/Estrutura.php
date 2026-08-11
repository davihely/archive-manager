<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;

class Estrutura
{
    private string $disk = 'c-drive';

    public function criar(array $data): bool
    {
        $path = $data['path'] . "/" . $data['inputValue'];
        $storage = Storage::disk($this->disk);
        return $data['structureType'] === 'folder'
            ? $storage->makeDirectory($path)
            : $storage->put($path, '');
    }

    public function renomear(string $path, string $novoNome): bool
    {
        $storage = Storage::disk($this->disk);
        $novoPath = dirname($path) . '/' . $novoNome;

        return $storage->move($path, $novoPath);
    }

    public function excluir(string $path, string $structureType): bool
    {
        $storage = Storage::disk($this->disk);

        return $structureType === 'folder'
            ? $storage->deleteDirectory($path)
            : $storage->delete($path);
    }
}
