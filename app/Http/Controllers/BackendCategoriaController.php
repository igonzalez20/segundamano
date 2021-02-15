<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class BackendCategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function index()
    {
        $user = auth()->user();
        if($user != null && $user->id == 1){    
            
            $categorias = Categoria::all();
            return view('backend.admin.categoria.index', ['categorias' => $categorias]);
            
        } else{
            return View('backend.index');
        }
        
    }

    public function create()
    {
        $user = auth()->user();
        if($user != null && $user->id == 1){                            
            return view('backend.admin.categoria.create');
            
        } else{
            return View('backend.index');
        }
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if($user != null && $user->id == 1){    
            
            $categoria = new Categoria();
            //dd($request);
            $categoria->nombre = $request->nombre;
            
            try{
                $result = $categoria->save();
            }catch(\Exception $e){
                $result = (array) $e;
            }

            if($categoria->id > 0){
                if(isset($request->imagen)) {
            
                    $file = $request->imagen;
                    
                    $name = $categoria->id.'categoria.'.$file->extension();
                    try {
                         //URL::to('/')
                         //dd($target = URL::to('/') . '/assets/pictures'.$name);
                        $file->move('assets/pictures/',$name);
                    
                    } catch (\Exception $e) {
                       dd($e->getMessage());
                    }

                    $response = ['op' => 'create', 'result' => $result, 'id' => $categoria->id];
                return redirect('backend/categoria')->with($response);
                } else{
                    $errorMsg ="algo ah ido mal";
                    return back()->withInput()->with(['error' => $errorMsg]);
                }
            }

            return View('home');
        } else{
            return View('backend.index');
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
        if($user != null && $user->id == 1){    
            $categoria = Categoria::find($id);
            
            try{
                $result = $categoria->update($request->all());    
            }catch(\Exception $e){
                $result = 0;
            }
            

            if($result){
                $response = ['op' => 'update', 'result' => $result, 'id' => $categoria->id];
                return redirect('backend/categoria')->with($response);
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
