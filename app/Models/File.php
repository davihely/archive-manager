<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;

class File
{
    private string $disk = 'c-drive';
    
    public function criar(array $arquivo): bool{
        if(Storage::disk($this->disk)->exists($arquivo['path'] . '/' . $arquivo['file']->getClientOriginalName())){
            throw new \RuntimeException("Já existe arquivo com o nome \"{$arquivo['file']->getClientOriginalName()}\" nesse local.");
        }

        Storage::disk($this->disk)->putFileAs(
            $arquivo['path'],
            $arquivo['file'],
            $arquivo['file']->getClientOriginalName()
        );

        return true;
    }
}
