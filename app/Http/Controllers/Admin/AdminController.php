<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Traits\HasRoles;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Rol;
use App\Models\Persona;
use App\Models\Semillero;
use App\Models\Evento;

class AdminController extends Controller
{
    public function listarUsuarios(){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol);
    
        $usuarios = User::all();
    
        return view('Admin.usuarios', compact('usuarios', 'user'));
    }
    
    public function vistaRegUsuarios(){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol);
    
        return view('Admin.vista_reg_usr', compact('user'));
    }

    public function registrarUsuario(Request $request){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol);    

        if (($request->input('passwd1')) === ($request->input('passwd2'))) {
            $validator = Validator::make($request->all(), [
                'nombre' => 'required',
                'email' => 'required|email|unique:users,email|ends_with:@udenar.edu.co',
                'passwd1' => 'required|min:6',
            ], [
                'nombre.required' => 'El campo nombre es obligatorio.',
                'email.required' => 'El campo correo es obligatorio.',
                'email.email' => 'El correo debe ser válido.',
                'email.unique' => 'El correo ya está registrado.',
                'email.ends_with' => 'El correo debe terminar en @udenar.edu.co.',
                'passwd1.required' => 'El campo contraseña es obligatorio.',
                'passwd1.min' => 'La contraseña debe tener al menos :min caracteres.',
            ]);
        
            // Comprobar si hay errores de validación
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }else{
                
                $nuevo_user = new User(); //instanciar el modelo
                $nuevo_user -> name = $request ->input('nombre');
                $nuevo_user -> email = $request ->input('email');
                $nuevo_user -> password = bcrypt($request ->input('passwd1'));

                $nuevo_user->save();//equivalente al incert

                if($request ->input('rol') === "1"){
                    $nuevo_user -> assignRole('semillerista');
                }else if($request ->input('rol') === "2"){
                    $nuevo_user -> assignRole('coordinador');
                }else if($request ->input('rol') === "3"){
                    $nuevo_user -> assignRole('admin');
                }

                return redirect()->route('v_reg_usr')->with('registroExitoso', true);
            }
        } else {
            $validator = Validator::make($request->all(), [], []);
        
            $validator->errors()->add('passwd2', 'Las contraseñas no coinciden.');
        
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function vistaEditUsuarios($id){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol);

        $usr_edit = User::findOrFail($id);

        $usr_rol = $usr_edit->getRoleNames()[0];

        $numRol = 1;

        switch ($usr_rol) {
            case 'semillerista':
                $numRol = 1;
                break;
            case 'coordinador':
                $numRol = 2;
                break;
            case 'admin':
                $numRol = 3;
                break;
        }
    
        return view('Admin.vista_edit_usr', compact('user', 'usr_edit', 'numRol', 'id'));
    }

    public function editUsuarios(Request $request, $id){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol);

        $usr_edit = User::findOrFail($id);

        if (($request->input('passwd1')) === ($request->input('passwd2'))) {
            $validator = Validator::make($request->all(), [
                'nombre' => 'required',
                'email' => 'required|email|ends_with:@udenar.edu.co',
                'passwd1' => 'required|min:6',
            ], [
                'nombre.required' => 'El campo nombre es obligatorio.',
                'email.required' => 'El campo correo es obligatorio.',
                'email.email' => 'El correo debe ser válido.',
                'email.ends_with' => 'El correo debe terminar en @udenar.edu.co.',
                'passwd1.required' => 'El campo contraseña es obligatorio.',
                'passwd1.min' => 'La contraseña debe tener al menos :min caracteres.',
            ]);

            if ($usr_edit->email !== $request->input('email')) {
                // Validar que el correo no esté registrado
                $validator->after(function ($validator) use ($request) {
                    $existingUser = User::where('email', $request->input('email'))->first();
                    if ($existingUser) {
                        $validator->errors()->add('email', 'El correo ya está registrado.');
                    }
                });
            }

            // Comprobar si hay errores de validación
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $usr_edit->name = $request->input('nombre');
                $usr_edit->email = $request->input('email');
                $usr_edit->password = bcrypt($request->input('passwd1'));

                $usr_edit->save();

                $usr_edit->removeRole($usr_edit->getRoleNames()[0]);

                if ($request->input('rol') === "1") {
                    $usr_edit->assignRole('semillerista');
                } else if ($request->input('rol') === "2") {
                    $usr_edit->assignRole('coordinador');
                } else if ($request->input('rol') === "3") {
                    $usr_edit->assignRole('admin');
                }

                return redirect()->route('usuarios')->with('registroExitoso', true);
            }
        } else {
            $validator = Validator::make($request->all(), [], []);

            $validator->errors()->add('passwd2', 'Las contraseñas no coinciden.');

            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function eliminarUsuario($id){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol);
    
        if ($id == $user->id) {
            return redirect()->route('usuarios')->with('noSuicidio', true);
        }else {
            return redirect()->route('usuarios', ['elimina' => $id])->with('preguntarEliminar', true);
        }
    }

    public function eliminarUsuarioConfirmado($id){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol);

        if ($id == $user->id) {
            return redirect()->route('usuarios')->with('noSuicidio', true);
        }else {
            $usr_del = User::findOrFail($id);
            $usr_del->delete();
            
            return redirect()->route('usuarios', ['eliminado' => $usr_del->name])->with('usuarioEliminado', true);

        }
    }

    public function perfil($id){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol);

        $usr_edit = User::findOrFail($id);
        $persona = Persona::where('usuario', $usr_edit->id)->first();
        if($persona !== null){
            return view('Admin.perfiles', ['persona' => $persona, 'user' => $user, 'usr_edit' => $usr_edit]);
        }else{
            return view('Admin.perfiles', ['user' => $user, 'usr_edit' => $usr_edit]);
        }
    }

    public function actualizarPerfil(Request $request, $id){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol);

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
            $usr_edit = User::findOrFail($id);
            $persona = Persona::where('usuario', $usr_edit->id)->first();

            if($persona !== null){
                $persona -> num_identificacion = $request ->input('num_identificacion');
                $persona -> tipo_identificacion = $request ->input('tipo_identificacion');
                $persona -> usuario = $usr_edit->id;
                $persona -> nombre = $request ->input('nombre');
                $persona -> correo = $usr_edit->email;
                $persona -> telefono = $request ->input('telefono');
                $persona -> direccion = $request ->input('direccion');
                $persona -> fecha_nac = $request ->input('fecha_nac');
                $persona -> sexo = $request ->input('sexo');
                $persona -> programa_academico = $request ->input('programa');
                
                $persona->save();

                return redirect()->route('perfiles', $usr_edit->id)->with('actualizacionExitosa', true);
            }else{
                $persona = new Persona();
                $persona -> num_identificacion = $request ->input('num_identificacion');
                $persona -> tipo_identificacion = $request ->input('tipo_identificacion');
                $persona -> usuario = $usr_edit->id;
                $persona -> nombre = $request ->input('nombre');
                $persona -> correo = $usr_edit->email;
                $persona -> telefono = $request ->input('telefono');
                $persona -> direccion = $request ->input('direccion');
                $persona -> fecha_nac = $request ->input('fecha_nac');
                $persona -> sexo = $request ->input('sexo');
                $persona -> programa_academico = $request ->input('programa');
                
                $persona->save();

                return redirect()->route('perfiles', $usr_edit->id)->with('actualizacionExitosa', true);
            }
        }
    }

    public function listarSemilleros(){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol, new Semillero());

        $semilleros = Semillero::all();
        
        return view('Admin.semilleros', compact('user','semilleros'));
        
    }
    
    public function agregarSemilleros(){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol, new Semillero());
        
        return view('Admin.agregar_semilleros', compact('user'));
    }
    
    public function listarEventos(){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol, new Evento());
        
        $eventos = Evento::all();
        
        return view('Admin.eventos', compact('user'));
    }

    public function vistaRegEventos(){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol, new Evento());
        
        return view('Admin.vista_reg_eventos', compact('user'));
    }

    public function registrarEventos(Request $r){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol, new Evento());

        $nuevo_evento = new Evento();

        $nuevo_evento->codigo_evento = $r->input('codigo_evento');
        $nuevo_evento->nombre = $r->input('nombre');
        $nuevo_evento->descripcion = $r->input('descripcion');
        $nuevo_evento->fecha_inicio = $r->input('fecha_inicio');
        $nuevo_evento->fecha_fin = $r->input('fecha_fin');
        $nuevo_evento->lugar = $r->input('lugar');
        $nuevo_evento->tipo = $r->input('tipo');
        $nuevo_evento->modalidad = $r->input('modalidad');
        $nuevo_evento->clasificacion = $r->input('clasificacion');
        $nuevo_evento->observaciones = $r->input('observaciones');
        $nuevo_evento->save();
        return redirect()->route('vista_reg_eventos')->with('registroExitoso', true);
    }
}