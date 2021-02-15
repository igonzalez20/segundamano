<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class BackendProductoController extends Controller
{
    static $estado = array('en venta', 'vendido', 'retirado', 'censurado');
    static $uso = array('nuevo', 'usado', 'gastado');
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');

        
    } 
    public function finalizar($id)
    {
        $producto = Producto::find($id);
        
        if($producto->estado == 0){
            $producto->estado = 1; 
        } else if($producto->estado == 1){
            $producto->estado = 0;
        }
        
        try{
            $result = $producto->save();

            }catch(\Exception $e){
                $result = (array) $e;
            }

            if($result){
                $response = ['op' => 'update', 'result' => $result, 'id' => $producto->id];
                return redirect('backend/producto')->with($response);
            } else {
                return back()->withInput()->with(['error' => 'algo ha fallado']);
            }
    }

    public function index()
    {
        $user = auth()->user(); 
        $categorias = Categoria::all();

        $productos = Producto::where('idusuario', $user->id)->get();

        return view('backend.producto.index', ['productos' => $productos, 'categorias' => $categorias, 'uso' => self::$uso, 'estado' => self::$estado]);
    }

    public function create()
    {
        $user = auth()->user();        
        $categorias = Categoria::all();
        //dd($categorias);
        return view('backend.producto.create', ['categorias' => $categorias, 'user' => $user]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();  
            
            $producto = new Producto();
            //dd($request);            
            $imagenes = array();
            

            if($request->hasfile('imagen')){
                //dd($request->imagen);                
                foreach($request->imagen as $file){
                    
                    $name = uniqid().'producto.'.$file->extension();
                    try {
                        //URL::to('/')
                        //dd($target = URL::to('/') . '/assets/pictures'.$name);
                        $file->move('assets/pictures/',$name);
                        array_push($imagenes, $name);
                        
                    } catch (\Exception $e) {
                       dd($e->getMessage());
                    } 
                }                
            }

            if(count($imagenes) > 0){
                $producto->idusuario = $user->id;
                $producto->nombre = $request->nombre;
                $producto->idcategoria = $request->idcategoria;
                $producto->descripcion = $request->descripcion;
                $producto->uso = $request->uso;
                $producto->precio = $request->precio;
                $producto->fecha = date('Y-m-d H:i:s');                
                $producto->estado = 0;
                $producto->imagen = $imagenes;
                
                try{
                $result = $producto->save();

                }catch(\Exception $e){
                    $result = (array) $e;
                }
            }
            if($producto->id > 0){
                $response = ['op' => 'create', 'result' => $result, 'id' => $producto->id];
                return redirect('backend/producto')->with($response);
            } else{
                $errorMsg ="algo ah ido mal";
                return back()->withInput()->with(['error' => $errorMsg]);
            }            
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        
        $user = auth()->user();
        if($user != null){    
            $producto = Producto::find($id);
            
            
            try{
                          
                $producto->nombre = $request->editnombre;
                $producto->idcategoria = $request->editidcategoria;
                $producto->descripcion = $request->editdescripcion;
                $producto->uso = $request->edituso;
                $producto->precio = $request->editprecio;                

                $result = $producto->save();
            }catch(\Exception $e){
                $result = 0;
            }
            

            if($result){
                $response = ['op' => 'update', 'result' => $result, 'id' => $producto->id];
                return redirect('backend/producto')->with($response);
            } else {
                return back()->withInput()->with(['error' => 'algo ha fallado']);
            }
        }
    }

    public function destroy($id)
    {
        //
    }
}
