<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComentarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        /* $comentarios = Comentario::all(); */
        $comentarios = Comentario::select(
            "comentarios.*", 'usuarios.usuario as usuario')
        ->join('usuarios', 'usuarios.carnet', '=', 'comentarios.id_usuario')
        ->get();

        /* Evaluar si hay o no registros */
        if($comentarios->count()>0){
            return response()->json([
                'code'=>200,
                'data'=>$comentarios
            ], 200);
        } else {
            return response()->json([
                'code'=>404,
                'data'=>'No hay registros de comentarios.'
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
            'contenido' => 'required',
            'id_publicacion' => 'required',
            'id_usuario' => 'required'
        ]);

        //Si falla la peticion
        if ($validacion ->fails()){
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        } else {
            $comentario = Comentario::create($request->all());
            return response()->json([
                'code' => 200,
                'data' => 'Comentario insertado.'
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function find($id){
        $comentario = Comentario::find($id);
        if ($comentario) {
            return response()->json([
                'code'=> 200,
                'data'=> $comentario
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'data'=> 'Comentario no encontrado.'
            ], 404);
        } 
    }

    public function show(Comentario $comentario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comentario $comentario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id){

        $validacion = Validator::make($request->all(), [
            'contenido' => 'required',
            'id_publicacion' => 'required',
            'id_usuario' => 'required'
        ]);

        //Si falla la peticion
        if ($validacion ->fails()){
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        } else {
            $comentario = Comentario::find($id);
            if ($comentario) {
                $comentario->update([
                    /* 'carnet'=>$request->carnet, */
                    'contenido'=>$request->contenido,
                    'id_publicacion'=>$request->id_publicacion,
                    'id_usuario'=>$request->id_usuario,
                ]);
                return response()->json([
                    'code' => 200,
                    'data' => 'Comentario actualizado.'
                ], 200);
            } else {
                return response()->json([
                    'code'=>404,
                    'data'=>'El comentario no existe.'
                ], 404);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id){
        $comentario = Comentario::find($id);
        if ($comentario) {
            $comentario->delete();
            return response()->json([
                'code'=> 200,
                'data'=> 'Comentario eliminado.'
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'data'=> 'Comentario no encontrado.'
            ], 404);
        }
    }
}
