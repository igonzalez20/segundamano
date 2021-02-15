<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deseo extends Model
{
    use HasFactory;

    protected $table = 'deseo';

    protected $fillable = ['idusuario', 'idproducto'];

    public function producto(){
        return $this->hasOne('App\Models\Producto', 'id', 'idproducto');
    }
}
