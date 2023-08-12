<?php

namespace App\Http\Controllers\Coordinador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semillero;
use App\Models\Proyecto;
use App\Models\Rol;
use App\Models\User;
use App\Models\Persona;


class CoordinadorController extends Controller
{
    public function index()
    {
        $semillero = new Semillero();
        $this->authorize('coordinador', $semillero);

        return view('Coordinador.index');
    }

    public function listarProyectos()
    {
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('coordinador.proyectos', $rol, new Proyecto());
    
        $proyectos = Proyecto::all();
    
        return view('Coordinador.proyectos', compact('proyectos', 'user'));
    }

    public function vistaAgrProyectos(){
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('coordinador.proyectos', $rol, new Proyecto());
    
        return view('Coordinador.vista_agr_proy', compact('user'));
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
