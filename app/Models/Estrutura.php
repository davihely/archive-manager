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
        $tipo = $data['structureType'] === 'folder' ? 'pasta' : 'arquivo';

        if ($storage->exists($path)) {
            throw new \RuntimeException("Já existe uma {$tipo} com o nome \"{$data['inputValue']}\" nesse local.");
        }

        $sucesso = $data['structureType'] === 'folder'
            ? $storage->makeDirectory($path)
            : $storage->put($path, '');

        if (!$sucesso) {
            throw new \RuntimeException("Não foi possível criar a {$tipo} \"{$data['inputValue']}\".");
        }

        return true;
    }

    public function renomear(string $path, string $novoNome): bool
    {
        $storage = Storage::disk($this->disk);

        if (!$storage->exists($path)) {
            throw new \RuntimeException("O item \"{$path}\" não existe mais.");
        }

        $novoPath = dirname($path) . '/' . $novoNome;

        if ($storage->exists($novoPath)) {
            throw new \RuntimeException("Já existe um item com o nome \"{$novoNome}\" nesse local.");
        }

        if (!$storage->move($path, $novoPath)) {
            throw new \RuntimeException("Não foi possível renomear \"{$path}\" para \"{$novoNome}\".");
        }

        return true;
    }

    public function excluir(string $path, string $structureType): bool
    {
        $storage = Storage::disk($this->disk);

        if (!$storage->exists($path)) {
            throw new \RuntimeException("O item \"{$path}\" não existe mais.");
        }

        $sucesso = $structureType === 'folder'
            ? $storage->deleteDirectory($path)
            : $storage->delete($path);

        if (!$sucesso) {
            throw new \RuntimeException("Não foi possível excluir \"{$path}\".");
        }

        return true;
    }
}
