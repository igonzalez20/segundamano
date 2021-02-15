<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    static $estado = array('en venta', 'vendido', 'retirado', 'censurado');
    static $uso = array('nuevo', 'usado', 'gastado');

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function single($nombre, $id)
    {        
        $producto = Producto::find($id);

        return view('frontend/single', ['producto' => $producto, 'uso' => self::$uso, 'estado' => self::$estado]);
    }
    public function index()
    {        
        return view('frontend/index');
    }

    public function shop()
    {
        $categorias = Categoria::all();
        $productos = Producto::all();        
        return view('frontend/shop', ['productos' => $productos, 'categorias' => $categorias]);
    }

    public function shopid($id)
    {
       
        if(isset($id)){
            $productos = Producto::where('idcategoria', $id)->get();
        } else{
            $productos = Producto::all();  
        }
        $categorias = Categoria::all();
              
        return view('frontend/shop', ['productos' => $productos, 'categorias' => $categorias]);
    }

    public function user()
    {
        return view('home');
    }
}
