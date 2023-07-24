<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Traits\HasRoles;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\User;
use App\Models\Rol;
use App\Models\Persona;
use App\Models\Semillero;
use App\Models\Semillerista;

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
            $persona_del = Persona::where('usuario', $usr_del->id)->first();
            if($persona_del !== null){
                if ($persona_del->foto !== null) {
                    Storage::delete($persona_del->foto);
                }
            }
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
    
        $usr_edit = User::findOrFail($id);
        $persona = Persona::where('usuario', $usr_edit->id)->first();
    
        if ($persona === null) {
            $persona = new Persona();
        }

        $persona->num_identificacion = $request->input('num_identificacion');
        $persona->tipo_identificacion = $request->input('tipo_identificacion');
        $persona->usuario = $usr_edit->id;
        $persona->nombre = $request->input('nombre');
        $persona->correo = $usr_edit->email;
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

        return redirect()->route('perfiles', $usr_edit->id)->with('actualizacionExitosa', true);
    }
    public function listarSemilleros(){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol, new Semillero());

        $semilleros =  DB::table('semilleros')->get();

        return view('Admin.semilleros', compact('user','semilleros'));

    }
    public function agregarSemilleros(){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol, new Semillero());

        return view('Admin.agregar_semilleros', compact('user'));
    }
    public function agregarSemillero(Request $request){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol, new Semillero());

        $validator = Validator::make($request->all(), [
            'id_semillero' => 'required',
            'sede' => 'required',
            'nombre' => 'required',
            'correo' => 'required',
            'logo' => 'required|image',
            'descripcion' => 'required',
            'mision' => 'required',
            'vision' => 'required',
            'valores' => 'required',
            'objetivos' => 'required',
            'lineas_inv' => 'required',
            'presentacion' => 'required',
            'fecha_creacion' => 'required',
            'num_res' => 'required',
            'resolucion' => 'required|mimes:pdf,doc,docx,ppt,pptx',
        ], [
            'id_semillero.required' => 'El campo ID del Semillero es requerido.',
            'sede.required' => 'El campo Sede es requerido.',
            'nombre.required' => 'El campo Nombre es requerido.',
            'correo.required' => 'El campo Correo es requerido.',
            'logo.required' => 'El campo Logo es requerido.',
            'logo.image' => 'El campo Logo debe ser una imagen.',
            'descripcion.required' => 'El campo Descripción es requerido.',
            'mision.required' => 'El campo Misión es requerido.',
            'vision.required' => 'El campo Visión es requerido.',
            'valores.required' => 'El campo Valores es requerido.',
            'objetivos.required' => 'El campo Objetivos es requerido.',
            'lineas_inv.required' => 'El campo Líneas de Investigación es requerido.',
            'presentacion.required' => 'El campo Presentación es requerido.',
            'fecha_creacion.required' => 'El campo Fecha de Creación es requerido.',
            'num_res.required' => 'El campo Número de Resolución es requerido.',
            'resolucion.required' => 'El campo Resolución es requerido.',
            'resolucion.mimes' => 'El campo Resolución debe ser un archivo de tipo PDF, Word o PowerPoint.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $semillero = new Semillero();

        $semillero->id_semillero = $request->input('id_semillero');
        $semillero->nombre = $request->input('nombre');
        $semillero->correo = $request->input('correo');
        $semillero->descripcion = $request->input('descripcion');
        $semillero->mision = $request->input('mision');
        $semillero->vision = $request->input('vision');
        $semillero->valores = $request->input('valores');
        $semillero->objetivos = $request->input('objetivos');
        $semillero->lineas_inv = $request->input('lineas_inv');
        $semillero->presentacion = $request->input('presentacion');
        $semillero->fecha_creacion = $request->input('fecha_creacion');
        $semillero->num_res = $request->input('num_res');

        if ($request->input('sede') === "1") {
            $semillero->sede = "Pasto";
        } else if ($request->input('sede') === "2") {
            $semillero->sede = "Ipiales";
        } else if ($request->input('sede') === "3") {
            $semillero->sede = "Túqueres";
        } else if ($request->input('sede') === "4") {
            $semillero->sede = "Tumaco";
        }

        $logo = $request->file('logo');
        if ($logo !== null && $logo->isValid()) {
            $rutaLogo = $logo->store('public/semilleros/logos');
            $semillero->logo = $rutaLogo;
        } else {
            return redirect()->back()->withErrors(['logo' => 'El campo Logo es inválido.'])->withInput();
        }

        $resolucion = $request->file('resolucion');
        if ($resolucion !== null && $resolucion->isValid()) {
            $rutaRes = $resolucion->store('public/semilleros/resoluciones');
            $semillero->resolucion = $rutaRes;
        } else {
            return redirect()->back()->withErrors(['resolucion' => 'El campo Resolución es inválido.'])->withInput();
        }

        $semillero->save();

        return redirect()->route('agregar_semilleros')->with('registroExitoso', true);
    }
    public function vistaActualizarSemillero($id){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol, new Semillero());

        $semillero = Semillero::findOrFail($id);

        return view('Admin.actualizar_semilleros', ['id_semillero_edit'=>$id, 'semillero' => $semillero, 'user' => $user]);
    }
    public function actualizarSemillero(Request $request, $id_semillero_edit){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol, new Semillero());

        $validator = Validator::make($request->all(), [
            'id_semillero' => 'required',
            'sede' => 'required',
            'nombre' => 'required',
            'correo' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'descripcion' => 'required',
            'mision' => 'required',
            'vision' => 'required',
            'valores' => 'required',
            'objetivos' => 'required',
            'lineas_inv' => 'required',
            'presentacion' => 'required',
            'fecha_creacion' => 'required',
            'num_res' => 'required',
            'resolucion' => 'nullable|mimes:pdf,doc,docx,ppt,pptx',
        ], [
            'id_semillero.required' => 'El campo ID del Semillero es requerido.',
            'sede.required' => 'El campo Sede es requerido.',
            'nombre.required' => 'El campo Nombre es requerido.',
            'correo.required' => 'El campo Correo es requerido.',
            'logo.image' => 'El campo Logo debe ser una imagen.',
            'descripcion.required' => 'El campo Descripción es requerido.',
            'mision.required' => 'El campo Misión es requerido.',
            'vision.required' => 'El campo Visión es requerido.',
            'valores.required' => 'El campo Valores es requerido.',
            'objetivos.required' => 'El campo Objetivos es requerido.',
            'lineas_inv.required' => 'El campo Líneas de Investigación es requerido.',
            'presentacion.required' => 'El campo Presentación es requerido.',
            'fecha_creacion.required' => 'El campo Fecha de Creación es requerido.',
            'resolucion.required' => 'El campo Resolución es requerido.',
            'resolucion.mimes' => 'El campo Resolución debe ser un archivo de tipo PDF, Word o PowerPoint.',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $semillero = DB::table('semilleros')->where('id_semillero', $id_semillero_edit)->first();

        $semilleroData = [
            'id_semillero' => $request->input('id_semillero'),
            'nombre' => $request->input('nombre'),
            'correo' => $request->input('correo'),
            'descripcion' => $request->input('descripcion'),
            'mision' => $request->input('mision'),
            'vision' => $request->input('vision'),
            'valores' => $request->input('valores'),
            'objetivos' => $request->input('objetivos'),
            'lineas_inv' => $request->input('lineas_inv'),
            'presentacion' => $request->input('presentacion'),
            'fecha_creacion' => $request->input('fecha_creacion'),
            'num_res' => $request->input('num_res'),
        ];

        if ($request->input('sede') === "1") {
            $semilleroData['sede'] = "Pasto";
        } else if ($request->input('sede') === "2") {
            $semilleroData['sede'] = "Ipiales";
        } else if ($request->input('sede') === "3") {
            $semilleroData['sede'] = "Túqueres";
        } else if ($request->input('sede') === "4") {
            $semilleroData['sede'] = "Tumaco";
        }

        $logo = $request->file('logo');
        if ($logo !== null && $logo->isValid()) {
            if ($semillero->logo !== null) {
                Storage::delete($semillero->logo);
            }

            $rutaLogo = $logo->store('public/semilleros/logos');
            $semilleroData['logo'] = $rutaLogo;
        }

        $resolucion = $request->file('resolucion');
        if ($resolucion !== null && $resolucion->isValid()) {
            if ($semillero->resolucion !== null) {
                Storage::delete($semillero->resolucion);
            }

            $rutaRes = $resolucion->store('public/semilleros/resoluciones');
            $semilleroData['resolucion'] = $rutaRes;
        }

        // Actualizar el registro en la base de datos
        DB::table('semilleros')->where('id_semillero', $id_semillero_edit)->update($semilleroData);

        return redirect()->route('vista_actualizar_semillero', $semilleroData['id_semillero'])->with('registroExitoso', true);
    }
    public function eliminarSemillero($id){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol, new Semillero());

        return redirect()->route('listar_semilleros', ['elimina' => $id])->with('preguntarEliminar', true);
    }
    public function eliminarSemilleroConfirmado($id){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol, new Semillero());

        $sem_del = Semillero::findOrFail($id);

        if ($sem_del->logo !== null) {
            Storage::delete($sem_del->logo);
        }

        if ($sem_del->resolucion !== null) {
            Storage::delete($sem_del->resolucion);
        }

        $sem_del->delete();
            
        return redirect()->route('listar_semilleros', ['eliminado' => $sem_del->nombre])->with('usuarioEliminado', true);
    }
    public function vistaParticipantes($id){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol, new Semillero());

        $semillero = Semillero::findOrFail($id);
        $participantes = Semillerista::where('semillero', $id);

        return view('Admin.participantes-semillero', compact('participantes', 'semillero', 'user'));
    }
    public function obtenerIdUsuario($num_identificacion){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol);

        $persona = Persona::where('num_identificacion', $num_identificacion)->first();

        return $persona->usuario;
    }
    public function obtenerNombrePersona($num_identificacion){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol);

        $persona = Persona::where('num_identificacion', $num_identificacion)->first();

        return $persona->nombre;
    }
    public function obtenerCorreoUsuario($num_identificacion){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('director', $rol);

        $persona = Persona::where('num_identificacion', $num_identificacion)->first();

        return $persona->correo;
    }
}