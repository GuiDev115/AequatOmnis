<?php

namespace App\Http\Controllers;

use App\Models\Jogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JogoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $jogos = Jogo::all();
            return response()->json($jogos);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Não foi possível obter os dados dos jogos. Verifique os dados e tente novamente'
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
                'titulo' => 'required|string|unique:jogos',
                'descricao' => 'required|string',
                'empresa' => 'required|string',
                'genero' => 'required|string',
                'plataforma' => 'required|string',
                'valor' => 'required|numeric|min:0',
                'estoque' => 'required|boolean'
            ]);

            $jogo = Jogo::create($request->all());
            return response()->json($jogo, 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Não foi possível salvar o jogo. Verifique os dados e tente novamente'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $jogo = Jogo::findOrFail($id);
            return response()->json($jogo);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Não foi possível obter os dados do jogo. Verifique os dados e tente novamente'
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
                'titulo' => 'sometimes|string|unique:jogos,titulo,' . $id,
                'descricao' => 'sometimes|string',
                'empresa' => 'sometimes|string',
                'genero' => 'sometimes|string',
                'plataforma' => 'sometimes|string',
                'valor' => 'sometimes|numeric|min:0',
                'estoque' => 'sometimes|boolean'
            ]);

            $jogo = Jogo::findOrFail($id);
            $jogo->update($request->all());
            return response()->json($jogo);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Não foi possível atualizar o jogo. Verifique os dados e tente novamente'
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $jogo = Jogo::findOrFail($id);
            $jogo->delete();
            return response()->json(['message' => 'Jogo removido com sucesso']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao remover o jogo, tente novamente'
            ], 400);
        }
    }

    /**
     * Upload featured image for a game
     */
    public function uploadFeaturedImage(Request $request, string $id)
    {
        try {
            $request->validate([
                'featuredImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $jogo = Jogo::findOrFail($id);
            
            if ($request->hasFile('featuredImage')) {
                $file = $request->file('featuredImage');
                $path = $file->store('images', 'public');
                
                // Remove old image if exists
                if ($jogo->featured_image) {
                    Storage::disk('public')->delete($jogo->featured_image);
                }
                
                $jogo->update(['featured_image' => $path]);
                
                return response()->json([
                    'message' => 'Imagem carregada com sucesso',
                    'featured_image' => $path
                ]);
            }
            
            return response()->json(['error' => 'Nenhuma imagem fornecida'], 400);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao fazer upload da imagem'
            ], 400);
        }
    }
}
