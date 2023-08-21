<?php

namespace App\Http\Controllers\Coordinador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semillero;
use App\Models\Coordinador;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Rol;
use App\Models\Semillerista;
use App\Models\Persona;
use App\Models\User;
use App\Models\Proyecto;
use App\Models\Evento;
use App\Models\Presentacion;
use App\Models\Integrante_Proy;

class CoordinadorController extends Controller
{
    public function index(){
        $semillero = new Semillero();
        $this->authorize('coordinador', $semillero);

        return view('Coordinador.index');
    }
    public function editarSemillero($id){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('coordinador', $rol);        
        $semillero = Semillero::findOrFail($id);
        return view('Coordinador.editarSemillero', ['id_semillero'=>$id, 'semillero' => $semillero, 'user' => $user]);
    }
    public function actualizarSemillero(Request $request, $id_semillero_edit){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        // $this->authorize('coordinador', $rol, new Semillero());

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

        return redirect()->route('vista_editar_semillero_cor', $semilleroData['id_semillero'])->with('registroExitoso', true);
    }
    public function verSemilleristas(){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('coordinador', $rol);

        $persona = DB::table('personas')->where('usuario', $user->id)->first();
        if($persona !== null){
            $coordinador = Coordinador::where('num_identificacion', $persona->num_identificacion)->first();
            $semillero = null;
            $id = null;
            $participantes = null;

            if($coordinador !== null){
                $semillero = Semillero::where('id_semillero', $coordinador->semillero)->first();
                if($semillero !== null){
                    $id = $semillero->id_semillero;
                    $participantes = Semillerista::where('semillero', $id)->get();
                }
            }
            return view('Coordinador.listaSemilleristas',compact('participantes', 'semillero', 'user', 'id'));
        }else{
            return redirect()->route('perfil')->with('actualizarProfa', true);
        }
    }
    public function obtenerNombrePersona($num_identificacion){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('coordinador', $rol);
        
        $persona = Persona::where('num_identificacion', $num_identificacion)->first();
        
        return $persona->nombre;
    }
    public function obtenerCorreoUsuario($num_identificacion){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('coordinador', $rol);

        $persona = Persona::where('num_identificacion', $num_identificacion)->first();
        
        return $persona->correo;
    }
    public function desvincularSemillero($num_identificacion){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('coordinador', $rol, new Semillero());
        
        $semillerista = Semillerista::findOrFail($num_identificacion);
        $semillerista->semillero = null;
        $semillerista->fecha_vinculacion = null;
        $semillerista->estado = "0";
        
        $semillerista->save();

        return redirect()->back()->with('desvinculacionExitosa', true);
    }
    public function listarProyectos(){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('coordinador.proyectos', $rol, new Proyecto());
        $persona = Persona::where('usuario', $user->id)->first();
       if($persona !== null){
            $coordinador = Coordinador::where('num_identificacion', $persona->num_identificacion)->first();
            $proyectos = null;
            if($coordinador !== null){
                $proyectos = Proyecto::where('semillero',$coordinador->semillero)->get();
            }
            $estadoOptions = [
                '1' => 'Propuesta',
                '2' => 'En curso',
                '3' => 'Finalizado',
                '4' => 'Inactivo',
            ];
            
            $tipoOptions = [
                '1' => 'Investigación',
                '2' => 'Innovación y Desarrollo',
                '3' => 'Emprendimiento',
            ];
            
            return view('Coordinador.proyectos', compact('proyectos', 'user','estadoOptions','tipoOptions'));
       }else{
            return redirect()->route('perfil')->with('actualizarProfa', true);
       }
    }
    public function vistaVincularProyecto($num_identificacion){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('coordinador.proyectos', $rol, new Proyecto());
        $persona = DB::table('personas')->where('usuario', $user->id)->first();
        $coordinador = Coordinador::findOrFail($persona->num_identificacion);
        $proyectos = Proyecto::where('semillero',$coordinador->semillero)->get();
        $estadoOptions = [
            '1' => 'Propuesta',
            '2' => 'En curso',
            '3' => 'Finalizado',
            '4' => 'Inactivo',
        ];
        
        $tipoOptions = [
            '1' => 'Investigación',
            '2' => 'Innovación y Desarrollo',
            '3' => 'Emprendimiento',
        ];
        
        return view('Coordinador.vista_vincular_proyecto', compact('user','proyectos','num_identificacion','estadoOptions','tipoOptions'));
    }
    public function addSemProyecto($num_identificacion){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('coordinador.proyectos', $rol, new Proyecto());
        $persona = DB::table('personas')->where('usuario', $user->id)->first();
        $coordinador = Coordinador::findOrFail($persona->num_identificacion);
        $proyectos = Proyecto::where('semillero',$coordinador->semillero)->get();
        
        return view('Coordinador.vista_vincular_proyecto', compact('user','proyectos','num_identificacion'));
    }
    public function vincularSemProyecto($num_identificacion, $id_proyecto) {
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('coordinador.proyectos', $rol, new Integrante_Proy());
        
        // Verificar si ya existe una vinculación
        $vinculacionExistente = Integrante_Proy::where('proyecto', $id_proyecto)
        ->where('semillerista', $num_identificacion)->exists();
        
        if ($vinculacionExistente) {
            // Redirigir con mensaje de "vinculación denegada"
            return redirect()->route('add_sem_proyecto', $num_identificacion)->with('vinculacionDenegada', true);
        }
        
        // Si no existe la vinculación, proceder a vincular
        $nuevo_proyecto_vinculado = new Integrante_Proy();
        $nuevo_proyecto_vinculado->proyecto = $id_proyecto;
        $nuevo_proyecto_vinculado->semillerista = $num_identificacion;
        $nuevo_proyecto_vinculado->campo = "Campo";
        $nuevo_proyecto_vinculado->save();
        
        return redirect()->back()->with('vinculacionExitosa', true);
    }
    public function desvincularProyecto($num_identificacion,$id_proyecto){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('coordinador', $rol, new Integrante_Proy());
        
        // Obtener la instancia del modelo Integrante_Proy
        $nuevo_proyecto_vinculado = Integrante_Proy::where('semillerista', $num_identificacion)
        ->where('proyecto', $id_proyecto)->first();
        
        if ($nuevo_proyecto_vinculado) {
            // Eliminar la fila completa
            $nuevo_proyecto_vinculado->delete();
        }
        
        return redirect()->back()->with('desvinculacionExitosa', true);
    }
    public function vistaVincularProyectoEvento($id_proyecto){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('coordinador.proyectos', $rol, new Proyecto());
        $eventos = Evento::all();        
        return view('Coordinador.vista_vincular_evento', compact('user','id_proyecto','eventos'));
    }
    public function addProyectoEvento($id_proyecto){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('coordinador.proyectos', $rol, new Proyecto());
        $eventos = Evento::all(); 
        return view('Coordinador.vista_vincular_evento', compact('user','eventos','id_proyecto'));
    }
    public function vincularProyectoEvento($id_proyecto,$codigo_evento) {
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('coordinador.proyectos', $rol, new Presentacion());
        
        // Verificar si ya existe una vinculación
        $vinculacionExistente = Presentacion::where('proyecto', $id_proyecto)
        ->where('evento', $codigo_evento)->exists();
        
        if ($vinculacionExistente) {
            // Redirigir con mensaje de "vinculación denegada"
            return redirect()->route('add_proyecto_evento', $codigo_evento)->with('vinculacionDenegada', true);
        }
        
        // Si no existe la vinculación, proceder a vincular
        $nuevo_proyecto_vinculado = new Presentacion();
        $nuevo_proyecto_vinculado->proyecto = $id_proyecto;
        $nuevo_proyecto_vinculado->evento = $codigo_evento;
        $nuevo_proyecto_vinculado->save();
        
        return redirect()->back()->with('vinculacionExitosa', true);
    }
    public function desvincularProyectoEvento($id_proyecto,$codigo_evento){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('coordinador', $rol, new Presentacion());
        
        // Obtener la instancia del modelo Presentacion
        $nuevo_proyecto_vinculado = Presentacion::where('proyecto', $id_proyecto)
        ->where('evento', $codigo_evento)->first();
        
        if ($nuevo_proyecto_vinculado) {
            $nuevo_proyecto_vinculado->delete();
        }
        
        return redirect()->back()->with('desvinculacionExitosa', true);
    }
    // public function vistaProyectoEventoVinculado($codigo_evento)
    // {
    //     $user = auth()->user();
    //     $nombre_rol = $user->getRoleNames()[0];
    //     $rol = Rol::where('name', $nombre_rol)->first();
    //     $this->authorize('coordinador.proyectos', $rol, new Proyecto());

    //     // dd($codigo_evento); 
    //     $presentaciones =  DB::table('presentaciones')->where('evento', $codigo_evento)->get();
    //     // dd($presentaciones); 
    //     $proyectos = collect(); // Inicializar una colección vacía
    
    //     foreach ($presentaciones as $presentacion) {
    //         $proyecto = Proyecto::find($presentacion->proyecto); // Buscar cada proyecto
    //         if ($proyecto) {
    //             $proyectos->push($proyecto); // Agregar proyecto a la colección
    //         }
    //     }
    //     $estadoOptions = [
    //         '1' => 'Propuesta',
    //         '2' => 'En curso',
    //         '3' => 'Finalizado',
    //         '4' => 'Inactivo',
    //     ];
        
    //     $tipoOptions = [
    //         '1' => 'Investigación',
    //         '2' => 'Innovación y Desarrollo',
    //         '3' => 'Emprendimiento',
    //     ];
    //     // $proyectos = Proyecto::all(); 
        
    //     return view('Coordinador.proyectosVinculadosEvento', compact('proyectos', 'user','estadoOptions','tipoOptions'));
    // }

    public function vistaAgrProyectos(){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('coordinador.proyectos', $rol, new Proyecto());
        $persona = DB::table('personas')->where('usuario', $user->id)->first();
        $coordinador = Coordinador::findOrFail($persona->num_identificacion);
    
        return view('Coordinador.vista_agr_proy', compact('user','coordinador'));
    }
    public function agregarProyecto(Request $request){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('coordinador.proyectos', $rol, new Proyecto());
        
        $nuevo_proyecto = new Proyecto();

        $nuevo_proyecto->id_proyecto = $request->input('id_proyecto');
        $nuevo_proyecto->semillero = $request->input('semillero');
        $nuevo_proyecto->titulo = $request->input('titulo');
        $nuevo_proyecto->tipo_proyecto = $request->input('tipo_proyecto');
        $nuevo_proyecto->estado = $request->input('estado');
        $nuevo_proyecto->feacha_inicio = $request->input('feacha_inicio');
        $nuevo_proyecto->feacha_fin = $request->input('feacha_fin');
        $nuevo_proyecto->arc_propuesta = $request->input('arc_propuesta');
        $nuevo_proyecto->arc_adjunto = $request->input('arc_adjunto');
        $nuevo_proyecto->save();
        
        return redirect()->route('vista_agr_proy')->with('registroExitoso', true);
    }
    public function vistaEditProyectos($id){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('coordinador.proyectos', $rol);
        
        $proyecto_id = Proyecto::findOrFail($id);

        return view('Coordinador.vista_edit_proy', compact('user','proyecto_id'));
    }
    public function editarProyectos(Request $r, $id){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('coordinador.proyectos', $rol);

        $proyecto_id = Proyecto::findOrFail($id);

        $proyecto_id->id_proyecto = $r->input('id_proyecto');
        $proyecto_id->semillero = $r->input('semillero');
        $proyecto_id->titulo = $r->input('titulo');
        $proyecto_id->tipo_proyecto = $r->input('tipo_proyecto');
        $proyecto_id->estado = $r->input('estado');
        $proyecto_id->feacha_inicio = $r->input('feacha_inicio');
        $proyecto_id->feacha_fin = $r->input('feacha_fin');
        $proyecto_id->arc_propuesta = $r->input('arc_propuesta');
        $proyecto_id->arc_adjunto = $r->input('arc_adjunto');
        $proyecto_id->save();

        return redirect()->route('proyectos')->with('registroExitoso', true);
    }
    public function eliminarProyecto($id){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('coordinador.proyectos', $rol);
    
        return redirect()->route('proyectos', ['elimina' => $id])->with('preguntarEliminar', true);
    }
    public function confirmacionEliminacionProyecto($id){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('coordinador.proyectos', $rol);

        $proyecto_del = Proyecto::findOrFail($id);
        $proyecto_del->delete();
        
        return redirect()->route('proyectos', ['eliminado' => $proyecto_del->nombre])->with('proyectoEliminado', true);
    }
}