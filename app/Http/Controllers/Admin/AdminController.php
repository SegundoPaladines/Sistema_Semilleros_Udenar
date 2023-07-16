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

class AdminController extends Controller
{
    public function listarUsuarios()
    {
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol);
    
        $usuarios = User::all();
    
        return view('Admin.usuarios', compact('usuarios', 'user'));
    }

    public function obtenerRol(User $user){
        return $user->getRoleNames()[0];
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

    public function editUsuarios(Request $request, $id)
    {
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

    public function eliminarUsuario($id)
    {
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

}