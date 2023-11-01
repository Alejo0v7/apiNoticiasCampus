<?php

namespace App\Http\Controllers;

use App\Models\TipoUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipoUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tUsuario = TipoUsuario::all();

        /* Evaluar si hay o no registros */
        if($tUsuario->count()>0){
            return response()->json([
                'code'=>200,
                'data'=>$tUsuario
            ], 200);
        } else {
            return response()->json([
                'code'=>404,
                'data'=>'No hay registros de los tipos de usuarios'
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
            $tUsuario = TipoUsuario::create($request->all());
            return response()->json([
                'code' => 200,
                'data' => 'Tipo de Usuario insertado'
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function find($id){
        $tUsuario = TipoUsuario::find($id);
        if ($tUsuario) {
            return response()->json([
                'code'=> 200,
                'data'=> $tUsuario
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'data'=> 'Tipo de usuario no encontrado'
            ], 404);
        } 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoUsuario $tipoUsuario)
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
            $tUsuario = TipoUsuario::find($id);
            if ($tUsuario) {
                $tUsuario->update([
                    'tipo'=>$request->tipo,
                ]);
                return response()->json([
                    'code' => 200,
                    'data' => 'Tipo de usuario actualizado'
                ], 200);
            } else {
                return response()->json([
                    'code'=>404,
                    'data'=>'El tipo de usuario no existe'
                ], 404);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id){
        $tUsuario = TipoUsuario::find($id);
        if ($tUsuario) {
            $tUsuario->delete();
            return response()->json([
                'code'=> 200,
                'data'=> 'Tipo de usuario eliminado'
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'data'=> 'Tipo de usuario no encontrado'
            ], 404);
        }
    }
}
