<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;

class BackendContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user(); 
        $enviados = Contacto::where('idusuario1', $user->id)->orderBy('created_at', 'DESC')->get();
        $recibidos = Contacto::where('idusuario2', $user->id)->orderBy('created_at', 'DESC')->get();
        /*$result = $enviados->toBase()->merge($recibidos)->SortBy('idproducto');
        $ultima = $result->SortBy('idproducto');
        dd($result);*/
        return view('backend.contacto.index', ['enviados' => $enviados, 'recibidos' => $recibidos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        if($user != null){    
            
            $contacto = new Contacto();
            
            $contacto->idusuario1 = $user->id;
            $contacto->idusuario2 = (int)$request->idusuario2;
            $contacto->idproducto = (int)$request->idproducto;            
            $contacto->textocontacto = $request->textocontacto;

            try{
               //dd($contacto);
                $result = $contacto->save();
                //dd($result);
            }catch(\Exception $e){
                $result = (array) $e;
            } 
            return back();         
            //return redirect('backend/producto')->with($result);
        } else{
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
