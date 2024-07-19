<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewsController extends Controller
{
    public function inicioView(){
        return view('inicio');
    }

    public function contactView(){
        return view('contact');
    }
    public function columnasView(){
        return view('columnas');
    }
    public function principalView(){
        return view('principal');
    }
    public function alumnosView(){
        return view('alumnos');
    }
    public function examenView(){
        return view('examen');
    }

    public function dashboard(){
        return view('templates.crud');
    }
}