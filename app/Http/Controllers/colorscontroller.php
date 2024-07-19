<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class colorscontroller extends Controller
{
    public function view(){
        return view('jsondinamico.colors');
    }
}
