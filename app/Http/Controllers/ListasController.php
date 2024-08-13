<?php

namespace App\Http\Controllers;

use App\Models\Lista;
use Illuminate\Http\Request;

class ListasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listas = Lista::all();
        return view('listas.index', compact('listas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'items.*.descricao' => 'required|string|max:255',
            'items.*.quantidade' => 'required|integer|min:1',
            'items.*.preco_unitario' => 'required|numeric|min:0.01',
        ]);

        if (empty($request->items)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'A lista deve conter pelo menos um item.');
        }

        $lista = Lista::create(['name' => $request->name]);

        foreach ($request->items as $item) {
            $lista->items()->create($item);
        }

        return redirect()
            ->route('listas.index')
            ->with('success', 'Lista criada com sucesso: ' . $lista->name);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('listas.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lista $lista)
    {
        return view('listas.show', compact('lista'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lista $lista)
    {
        return view('listas.edit', compact('lista'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lista $lista)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'items.*.descricao' => 'required|string|max:255',
            'items.*.quantidade' => 'required|integer|min:1',
            'items.*.preco_unitario' => 'required|numeric|min:0.01',
        ]);

        $lista->update(['name' => $request->name]);
        $lista->items()->delete();
        foreach ($request->items as $item) {
            $lista->items()->create($item);
        }

        return redirect()
            ->route('listas.index')
            ->with('success', 'Lista atualizada com sucesso: ' . $lista->name);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lista $lista)
    {
        $lista->delete();
        return redirect()
            ->route('listas.index')
            ->with('success', 'Lista removida com sucesso: ' . $lista->name);
    }
}
