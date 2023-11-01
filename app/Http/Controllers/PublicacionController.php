<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $publicaciones = Publicacion::all();

        /* Evaluar si hay o no registros */
        if($publicaciones->count()>0){
            return response()->json([
                'code'=>200,
                'data'=>$publicaciones
            ], 200);
        } else {
            return response()->json([
                'code'=>404,
                'data'=>'No hay registros de publicaciones.'
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
            'titulo' => 'required',
            'subtitulo' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required',
            'destacado' => 'required',
            'visible' => 'required',
            'imagen' => 'required',
            'id_categoria' => 'required',
            'id_tipo_publicacion' => 'required',
            'id_usuario' => 'required'
        ]);

        //Si falla la peticion
        if ($validacion ->fails()){
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        } else {
            $publicacion = Publicacion::create($request->all());
            return response()->json([
                'code' => 200,
                'data' => 'Publicación insertada.'
            ], 200);
        }
    }

    public function find($id){
        $publicacion = Publicacion::find($id);
        if ($publicacion) {
            return response()->json([
                'code'=> 200,
                'data'=> $publicacion
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'data'=> 'Publicación no encontrada.'
            ], 404);
        } 
    }
    /**
     * Display the specified resource.
     */
    public function show(Publicacion $publicacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publicacion $publicacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id){

        $validacion = Validator::make($request->all(), [
            'titulo' => 'required',
            'subtitulo' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required',
            'destacado' => 'required',
            'visible' => 'required',
            'imagen' => 'required',
            'id_categoria' => 'required',
            'id_tipo_publicacion' => 'required',
            'id_usuario' => 'required'
        ]);

        //Si falla la peticion
        if ($validacion ->fails()){
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        } else {
            $publicacion = Publicacion::find($id);
            if ($publicacion) {
                $publicacion->update([
                    'titulo'=>$request->titulo,
                    'subtitulo'=>$request->subtitulo,
                    'descripcion'=>$request->descripcion,
                    'fecha'=>$request->fecha,
                    'destacado'=>$request->destacado,
                    'visible'=>$request->visible,
                    'imagen'=>$request->imagen,
                    'id_categoria'=>$request->id_categoria,
                    'id_tipo_publicacion'=>$request->id_tipo_publicacion,
                    'id_usuario'=>$request->id_usuario
                ]);
                return response()->json([
                    'code' => 200,
                    'data' => 'Publicación actualizada.'
                ], 200);
            } else {
                return response()->json([
                    'code'=>404,
                    'data'=>'La publicación no existe.'
                ], 404);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id){
        $publicacion = Publicacion::find($id);
        if ($publicacion) {
            $publicacion->delete();
            return response()->json([
                'code'=> 200,
                'data'=> 'Publicación eliminada.'
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'data'=> 'Publicación no encontrada.'
            ], 404);
        }
    }
}
