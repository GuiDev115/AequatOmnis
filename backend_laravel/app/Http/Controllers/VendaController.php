<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $vendas = Venda::all();
            return response()->json($vendas);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Não foi possível obter os dados das vendas. Verifique os dados e tente novamente'
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nome_produto' => 'required|string',
                'comprador' => 'required|string',
                'email' => 'required|email',
                'total' => 'required|numeric|min:0'
            ]);

            $venda = Venda::create($request->all());
            return response()->json($venda, 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Não foi possível salvar a venda. Verifique os dados e tente novamente'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $venda = Venda::findOrFail($id);
            return response()->json($venda);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Não foi possível obter os dados da venda. Verifique os dados e tente novamente'
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'nome_produto' => 'sometimes|string',
                'comprador' => 'sometimes|string',
                'email' => 'sometimes|email',
                'total' => 'sometimes|numeric|min:0'
            ]);

            $venda = Venda::findOrFail($id);
            $venda->update($request->all());
            return response()->json($venda);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Não foi possível atualizar a venda. Verifique os dados e tente novamente'
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $venda = Venda::findOrFail($id);
            $venda->delete();
            return response()->json(['message' => 'Venda removida com sucesso']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao remover a venda, tente novamente'
            ], 400);
        }
    }
}
