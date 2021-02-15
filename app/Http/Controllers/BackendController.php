<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackendController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    function main(){
        $user = auth()->user();
        if($user != null && $user->id == 1){            
            return View('backend.admin.index');                
        } else{
            return View('backend.index');
        }
        
    }
}
