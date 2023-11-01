<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        /* $usuarios = Usuario::all(); */

        $usuarios = Usuario::select("usuarios.*", 'tipo_usuario.tipo as tipo_usuario')
        ->join('tipo_usuario', 'tipo_usuario.id', '=', 'usuarios.tipo_usuario')->get();
        /* Evaluar si hay o no registros */
        if($usuarios->count()>0){
            return response()->json([
                'code'=>200,
                'data'=>$usuarios
            ], 200);
        } else {
            return response()->json([
                'code'=>404,
                'data'=>'No hay registros de usuarios.'
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
            'carnet' => 'required',
            'correo' => 'required',
            'usuario' => 'required',
            'tipo_usuario' => 'required'
        ]);

        //Si falla la peticion
        if ($validacion ->fails()){
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        } else {
            $usuario = Usuario::create($request->all());
            return response()->json([
                'code' => 200,
                'data' => 'Usuario insertado.'
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function find($id){
        $usuario = Usuario::find($id);
        if ($usuario) {
            return response()->json([
                'code'=> 200,
                'data'=> $usuario
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'data'=> 'Usuario no encontrado.'
            ], 404);
        } 
    }

    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id){

        $validacion = Validator::make($request->all(), [
            /* 'carnet' => 'required', */
            'correo' => 'required',
            'usuario' => 'required',
            'tipo_usuario' => 'required'
        ]);

        //Si falla la peticion
        if ($validacion ->fails()){
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        } else {
            $usuario = Usuario::find($id);
            if ($usuario) {
                $usuario->update([
                    /* 'carnet'=>$request->carnet, */
                    'correo'=>$request->correo,
                    'usuario'=>$request->usuario,
                    'tipo_usuario'=>$request->tipo_usuario,
                ]);
                return response()->json([
                    'code' => 200,
                    'data' => 'Usuario actualizado.'
                ], 200);
            } else {
                return response()->json([
                    'code'=>404,
                    'data'=>'El usuario no existe.'
                ], 404);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id){
        $usuario = Usuario::find($id);
        if ($usuario) {
            $usuario->delete();
            return response()->json([
                'code'=> 200,
                'data'=> 'Usuario eliminado.'
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'data'=> 'Usuario no encontrado.'
            ], 404);
        }
    }
}
