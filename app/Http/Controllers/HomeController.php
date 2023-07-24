<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Persona;
use App\Models\User;
use App\Models\Semillerista;

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
            'foto' => 'nullable|image|max:2048',
        ], [
            'num_identificacion.required'=>'El Numero de identificacion no puede estar vacío',
            'tipo_identificacion.required'=>'El tipo de identificacion no puede estar vacío',
            'nombre.required'=>'El nombre no puede estar vacío',
            'telefono.required'=>'El telefono no puede estar vacío',
            'direccion.required'=>'La dirección no puede estar vacía',
            'fecha_nac.required'=>'La fecha de nacimiento no puede estar vacía',
            'sexo.required'=>'El sexo no puede estar vacío',
            'programa.required'=>'El programa academico no puede estar vacío',
            'foto.image' => 'El archivo debe ser una imagen',
            'foto.max' => 'El tamaño de la imagen no puede ser mayor a 2MB',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $user = auth()->user();
        $persona = Persona::where('usuario', $user->id)->first();
    
        if ($persona === null) {
            $persona = new Persona();
        }

        $persona->num_identificacion = $request->input('num_identificacion');
        $persona->tipo_identificacion = $request->input('tipo_identificacion');
        $persona->usuario = $user->id;
        $persona->nombre = $request->input('nombre');
        $persona->correo = $user->email;
        $persona->telefono = $request->input('telefono');
        $persona->direccion = $request->input('direccion');
        $persona->fecha_nac = $request->input('fecha_nac');
        $persona->sexo = $request->input('sexo');
        $persona->programa_academico = $request->input('programa');
    
        $imagen = $request->file('foto');
        if ($imagen !== null && $imagen->isValid()) {
            if ($persona->foto !== null) {
                Storage::delete($persona->foto);
            }

            $rutaFoto = $imagen->store('public/perfiles/imagenes');
            $persona->foto = $rutaFoto;
        }

        $persona->save();

        $nombre_rol = $user->getRoleNames()[0];
        if($nombre_rol == 'semillerista'){
            return redirect()->route('vista_actualizar_datos_semillerista');
        }else{
            return redirect()->route('perfil')->with('actualizacionExitosa', true);
        }
    }
    public function actualizarContrasena(){
        $user = auth()->user();

        return view('reset-psswd')->with('user', $user);
    }
    public function cambiarContrasena(Request $request){
        $user = auth()->user();
        $usr_edit = User::findOrFail($user->id);

        $validator = Validator::make($request->all(), [
            'passwd1' => 'required|min:6',
            'passwd2' => 'required|min:6',
            'passwd3' => 'required|min:6',
        ], [
            'passwd1.min' => 'La contraseña debe tener al menos :min caracteres.',
            'passwd2.min' => 'La contraseña debe tener al menos :min caracteres.',
            'passwd3.min' => 'La contraseña debe tener al menos :min caracteres.',
            'passwd1.required' => 'La contraseña vieja no puede estar vacia.',
            'passwd2.required' => 'La contraseña nueva no puede estar vacia',
            'passwd3.required' => 'La contraseña nueva no puede estar vacia',
        ]);
        
        if (!password_verify($request->input('passwd1'), $usr_edit->password)) {
            $validator = Validator::make($request->all(), [], []);
            $validator->errors()->add('passwd1', 'Contraseña Incorrecta.');

            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            if (($request->input('passwd2')) === ($request->input('passwd3'))) {
                // Comprobar si hay errores de validación
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                } else {
                    $user->password = bcrypt($request->input('passwd2'));
                    $user->save();
                    
                    return redirect()->route('cambiar-contrasena')->with('cambioExitoso', true);
                }
            } else {
                $validator = Validator::make($request->all(), [], []);
    
                $validator->errors()->add('passwd2', 'Las contraseñas no coinciden.');
                $validator->errors()->add('passwd3', 'Las contraseñas no coinciden.');
    
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
    }
}
