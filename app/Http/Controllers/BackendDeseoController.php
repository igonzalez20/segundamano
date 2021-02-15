<?php

namespace App\Http\Controllers;

use App\Models\Deseo;
use Illuminate\Http\Request;

class BackendDeseoController extends Controller
{
    public function index()
    {
        $user = auth()->user(); 
        $deseos = Deseo::where('idusuario', $user->id)->get();               
        return view('backend.deseo.index', ['deseos' => $deseos]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $user = auth()->user(); 
        
        $repeatDeseo = Deseo::where('idusuario', $user->id)->where('idproducto', $request->idproductodeseo)->get();
        if(count($repeatDeseo) > 0){
            //dd($repeatDeseo);
            $errorMsg ="ya existe un deseo asociado a este producto";
            return back()->withInput()->with(['error' => $errorMsg]);
        } else{
            $deseo = new Deseo();
            
            $deseo->idusuario = $user->id;
            $deseo->idproducto = $request->idproductodeseo;
            
            try{
                $result = $deseo->save();
                }catch(\Exception $e){
                    $result = (array) $e;
                }
            
            if($deseo->id > 0){
                $response = ['op' => 'create', 'result' => $result, 'id' => $deseo->id];
                return back()->with(['result' => $response]);
            } else{
                $errorMsg ="algo ha ido mal";
                return back()->withInput()->with(['error' => $errorMsg]);
            }      
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
        //
    }

    public function destroy(Deseo $deseo)
    {
        
       
        try{
            $result = $deseo->delete();    
        }catch(\Exception $e){
            $result = 0;
        }
       
        if($result){
            $response = ['op' => 'destroy', 'result' => $result, 'id' => $deseo->id];
            return back()->with(['result' => $response]);
        } else{
            $errorMsg ="algo ha ido mal";
            return back()->with(['error' => $errorMsg]);
            //return redirect('backend/deseo')->with(['error' => $errorMsg]);            
        }
        
        
    }
}
