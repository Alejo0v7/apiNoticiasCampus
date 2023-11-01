<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();

        /* Evaluar si hay o no registros */
        if($categorias->count()>0){
            return response()->json([
                'code'=>200,
                'data'=>$categorias
            ], 200);
        } else {
            return response()->json([
                'code'=>404,
                'data'=>'No hay registros de categorias'
            ], 404);
        }
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
        $validacion = Validator::make($request->all(), [
            'nombre' => 'required',
        ]);

        //Si falla la peticion
        if ($validacion ->fails()){
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        } else {
            $categorias = Categoria::create($request->all());
            return response()->json([
                'code' => 200,
                'data' => 'Categoria insertada'
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function find($id){
        $categorias = Categoria::find($id);
        if ($categorias) {
            return response()->json([
                'code'=> 200,
                'data'=> $categorias
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'data'=> 'Categoria no encontrada'
            ], 404);
        } 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id){
        $validacion = Validator::make($request->all(), [
            'nombre' => 'required',
        ]);

        //Si falla la peticion
        if ($validacion ->fails()){
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        } else {
            $categorias = Categoria::find($id);
            if ($categorias) {
                $categorias->update([
                    'nombre'=>$request->nombre,
                ]);
                return response()->json([
                    'code' => 200,
                    'data' => 'Categoria actualizada'
                ], 200);
            } else {
                return response()->json([
                    'code'=>404,
                    'data'=>'La categoria no existe'
                ], 404);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id){
        $categorias = Categoria::find($id);
        if ($categorias) {
            $categorias->delete();
            return response()->json([
                'code'=> 200,
                'data'=> 'Categoria eliminada'
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'data'=> 'Categoria no encontrada'
            ], 404);
        }
    }
}
