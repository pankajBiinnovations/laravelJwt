<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function set(Request $request)
    {
        $request->session()->put('name','pankaj');
        echo "session is stored";
    }
    public function get(Request $request)
    {
        if($request->session()->has('name')){
            echo $request->session()->get('name');
        }else{
            echo "Session does not exist";
        }
        
    }
    public function forget(Request $request)
    {
        $request->session()->forget('name');
            
            echo "Session deleted";
        
        
    }
}
