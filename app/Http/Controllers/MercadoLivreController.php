<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MercadoLivreController extends Controller
{

    /**
     * Função que receberá as notificação do ML
     *
     * @param Request $request
     * @return void
     */
    public function handleCallback(Request $request)
    {

        $data = $request->all();
        // Separa as notificações,
        // Registra na tabela de pedidos
        
        // ...

        // dd($data);
        
        return response()->json($data, 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "OUK aqui funciona";
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
