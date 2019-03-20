<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function attractions(){
        return view('attractions.index');
    }

    public function attraction($id){
        return view('attractions.details');
    }
}
