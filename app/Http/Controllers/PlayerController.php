<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index()
    {
        return view('player.index');
    }

    public function platyerRegister()
    {
        return view('player.register');
    }
}
