<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;

    protected $table = 'contacto';

    protected $fillable = ['idusuario1', 'idusuario2', 'idproducto', 'textocontacto'];

    public function producto(){
        return $this->hasOne('App\Models\Producto', 'id', 'idproducto');
    }

    public function getidusuario1(){
        return $this->hasOne('App\Models\User', 'id', 'idusuario1');
    }

    public function getidusuario2(){
        return $this->hasOne('App\Models\User', 'id', 'idusuario2');
    }
}
