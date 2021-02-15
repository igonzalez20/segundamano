<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $casts = [
        'imagen' => 'array'
    ];

    protected $table = 'producto';

    protected $fillable = ['idusuario', 'idcategoria', 'nombre', 'descripcion', 'uso', 'precio', 'fecha', 'estado', 'imagen'];

    public function categoria(){
        return $this->belongsTo('App\Models\categoria', 'idcategoria', 'id');
    }
}
