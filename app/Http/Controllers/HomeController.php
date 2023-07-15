<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('index')->with('user', $user);
    }
    public function login(){
        if (auth()->check()) {
            $user = auth()->user();
            return view('index')->with('user', $user);
        } else {
            session()->flash('openModal', true);
            return view('welcome');
        }
    }
    public function welcome() {
        session()->forget('openModal');
        return view('welcome');
    }
}
