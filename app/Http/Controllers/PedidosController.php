<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePedidosRequest;
use App\Http\Requests\UpdatePedidosRequest;
use App\Models\Pedido;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePedidosRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedidos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedidos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePedidosRequest $request, Pedido $pedidos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedidos)
    {
        //
    }
}
