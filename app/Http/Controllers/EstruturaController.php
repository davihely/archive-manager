<?php

namespace App\Http\Controllers;

use App\Models\Estrutura;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EstruturaController extends Controller
{
    public function __construct(private Estrutura $estrutura)
    {
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $data = $request->validate([
                'path' => ['required', 'string'],
                'structureType' => ['required', 'in:file,folder'],
                'inputValue' => ['required', 'string'],
                'type' => ['required', 'string']
            ]);
            $this->estrutura->criar($data);
        }catch(\RuntimeException $e){
            return back()->withErrors(['message' => $e->getMessage()]);
        }

        return back();
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'path' => ['required', 'string'],
            'inputValue' => ['required', 'string'],
        ]);

        $this->estrutura->renomear($data['path'], $data['inputValue']);

        return back();
    }

    public function destroy(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'path' => ['required', 'string'],
            'structureType' => ['required', 'in:file,folder'],
        ]);

        $this->estrutura->excluir($data['path'], $data['structureType']);

        return back();
    }
}
