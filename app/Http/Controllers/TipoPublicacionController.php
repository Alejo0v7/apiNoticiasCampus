<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoPublicacion;
use Illuminate\Support\Facades\Validator;

class TipoPublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 
        $tPublicacion = TipoPublicacion::all();

        /* Evaluar si hay o no registros */
        if($tPublicacion->count()>0){
            return response()->json([
                'code'=>200,
                'data'=>$tPublicacion
            ], 200);
        } else {
            return response()->json([
                'code'=>404,
                'data'=>'No hay registros de los tipos de publicación'
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
            'tipo' => 'required',
        ]);

        //Si falla la peticion
        if ($validacion ->fails()){
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        } else {
            $tPublicacion = TipoPublicacion::create($request->all());
            return response()->json([
                'code' => 200,
                'data' => 'Tipo de Publicación insertada'
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function find($id){
        $tPublicacion = TipoPublicacion::find($id);
        if ($tPublicacion) {
            return response()->json([
                'code'=> 200,
                'data'=> $tPublicacion
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'data'=> 'Tipo de publicación no encontrada'
            ], 404);
        } 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoPublicacion $tipoPublicacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id){
        $validacion = Validator::make($request->all(), [
            'tipo' => 'required',
        ]);

        //Si falla la peticion
        if ($validacion ->fails()){
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        } else {
            $tPublicacion = TipoPublicacion::find($id);
            if ($tPublicacion) {
                $tPublicacion->update([
                    'tipo'=>$request->tipo,
                ]);
                return response()->json([
                    'code' => 200,
                    'data' => 'Tipo de publicación actualizada'
                ], 200);
            } else {
                return response()->json([
                    'code'=>404,
                    'data'=>'El tipo de publicación no existe'
                ], 404);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id){
        $tPublicacion = TipoPublicacion::find($id);
        if ($tPublicacion) {
            $tPublicacion->delete();
            return response()->json([
                'code'=> 200,
                'data'=> 'Tipo de publicación eliminada'
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'data'=> 'Tipo de publicación no encontrada'
            ], 404);
        }
    }
}
