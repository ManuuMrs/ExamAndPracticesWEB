<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class jsoncontroller extends Controller
{
    public function view(){
        return view('jsondinamico.jsondinamico');
    }
}
