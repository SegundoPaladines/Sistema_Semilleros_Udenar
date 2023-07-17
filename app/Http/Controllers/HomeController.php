<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Persona;

class HomeController extends Controller
{
    public function index(){
        $user = auth()->user();
        $persona = Persona::where('usuario', $user->id)->first();
        if($persona !== null){
            return view('index')->with('user', $user);
        }else{
            return redirect()->route('perfil')->with('actualizarProfa', true);
        }
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
    public function registarUsuarios() {
        return redirect()->route('v_reg_usr');
    }
    public function postUsuarios() {
        return redirect()->route('registar_usuario');
    }
    public function perfil(){
        $user = auth()->user();
        $persona = Persona::where('usuario', $user->id)->first();
        if($persona !== null){
            return view('perfil', ['persona' => $persona, 'user' => $user]);
        }else{
            return view('perfil')->with('user', $user);
        }
    }
    public function actualizarPerfil(Request $request){
        $validator = Validator::make($request->all(), [
            'num_identificacion' => 'required',
            'tipo_identificacion' => 'required',
            'nombre' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'fecha_nac' => 'required',
            'sexo' => 'required',
            'programa' => 'required',
        ], [
            'num_identificacion.required'=>'El Numero de identificacion no puede estár Vacio',
            'tipo_identificacion.required'=>'El tipo de identificacion no puede estár Vacio',
            'nombre.required'=>'El nombre no puede estár Vacio',
            'telefono.required'=>'El telefono no puede estár Vacio',
            'direccion.required'=>'La direccion no puede estár Vacio',
            'fecha_nac.required'=>'La fecha de nacimiento no puede estár Vacia',
            'sexo.required'=>'El sexo no puede estár Vacio',
            'programa.required'=>'El programa academico no puede estár Vacio',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $user = auth()->user();
            $persona = Persona::where('usuario', $user->id)->first();

            if($persona !== null){
                $persona -> num_identificacion = $request ->input('num_identificacion');
                $persona -> tipo_identificacion = $request ->input('tipo_identificacion');
                $persona -> usuario = $user->id;
                $persona -> nombre = $request ->input('nombre');
                $persona -> correo = $user->email;
                $persona -> telefono = $request ->input('telefono');
                $persona -> direccion = $request ->input('direccion');
                $persona -> fecha_nac = $request ->input('fecha_nac');
                $persona -> sexo = $request ->input('sexo');
                $persona -> programa_academico = $request ->input('programa');
                
                $persona->save();

                return redirect()->route('perfil')->with('actualizacionExitosa', true);
            }else{
                $persona = new Persona();
                $persona -> num_identificacion = $request ->input('num_identificacion');
                $persona -> tipo_identificacion = $request ->input('tipo_identificacion');
                $persona -> usuario = $user->id;
                $persona -> nombre = $request ->input('nombre');
                $persona -> correo = $user->email;
                $persona -> telefono = $request ->input('telefono');
                $persona -> direccion = $request ->input('direccion');
                $persona -> fecha_nac = $request ->input('fecha_nac');
                $persona -> sexo = $request ->input('sexo');
                $persona -> programa_academico = $request ->input('programa');
                
                $persona->save();

                $persona = Persona::where('usuario', $user->id)->first();
                return redirect()->route('perfil')->with('actualizacionExitosa', true);
            }
        }
    }
}
