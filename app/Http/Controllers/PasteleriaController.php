<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PasteleriaController extends Controller
{
    public function principal(){
        return "hola";
    }

    public function signin(){
        return view("login");
    }
}
