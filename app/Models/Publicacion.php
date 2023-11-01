<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    protected $table = 'publicacion';
    protected $fillable = [
        'titulo',
        'subtitulo'	,
        'descripcion',
        'fecha',
        'destacado',
        'visible',
        'imagen',	
        'id_categoria',
        'id_tipo_publicacion',
        'id_usuario',
    ];
}
