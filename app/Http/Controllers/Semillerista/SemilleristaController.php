<?php

namespace App\Http\Controllers\Semillerista;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Persona;
use App\Models\User;
use App\Models\Semillerista;
use App\Http\Controllers\Controller;
use App\Models\Proyecto;
use App\Models\Rol;
use App\Models\Integrante_Proy;

class SemilleristaController extends Controller
{
    public function vistaActualizarDatos(){
        $user = auth()->user();
        $persona = Persona::where('usuario', $user->id)->first();
        $semillerista = Semillerista::where('num_identificacion', $persona->num_identificacion)->first();
        return view('Semillerista.actualizar-info', compact('user', 'persona', 'semillerista'));
    }
    public function actualizarDatos(Request $request){
        $user = auth()->user();
        $persona = Persona::where('usuario', $user->id)->first();

        if ($persona === null) {
            return redirect()->back()->with('error', 'No se encontró la información de la persona asociada a este usuario.');
        }else{
            $validator = Validator::make($request->all(), [
                'cod_estudiante' => 'required|max:255',
                'semestre' => 'required|integer|between:1,10',
                'reporte_matricula' => 'required|mimes:pdf|max:2048',
            ], [
                'cod_estudiante.required' => 'El código estudiantil es obligatorio.',
                'cod_estudiante.max' => 'El código estudiantil no debe exceder los 255 caracteres.',
                'semestre.required' => 'El semestre es obligatorio.',
                'semestre.integer' => 'El semestre debe ser un número entero.',
                'semestre.between' => 'El semestre debe estar entre 1 y 10.',
                'reporte_matricula.required' => 'El reporte de matrícula es obligatorio.',
                'reporte_matricula.mimes' => 'El reporte de matrícula debe ser un archivo PDF.',
                'reporte_matricula.max' => 'El tamaño máximo del reporte de matrícula es de 2 MB.',
            ]);
        
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            
            $semillerista = Semillerista::where('num_identificacion', $persona->num_identificacion)->first();
        
            if ($semillerista === null) {
                $semillerista = new Semillerista();
                $semillerista->num_identificacion = $persona->num_identificacion;
            }
            
            $semillerista->cod_estudiante = $request->input('cod_estudiante');
            $semillerista->semestre = $request->input('semestre');
    
            $reporte = $request->file('reporte_matricula');
            if ($reporte !== null && $reporte->isValid()) {
                if ($semillerista->reporte_matricula !== null) {
                    Storage::delete($semillerista->reporte_matricula);
                }
    
                $rutaReporte = $reporte->store('public/perfiles/semilleristas/reportes');
                $semillerista->reporte_matricula = $rutaReporte;
            }
            $semillerista->save();
            
            //revisar
            return redirect()->back()->with('actualizacionExitosa', true);
        }
    }

    public function listarProyectos()
    {
        $user = auth()->user();
        $nombre_rol = $user->getRoleNames()[0];
        $rol = Rol::where('name', $nombre_rol)->first();
        $this->authorize('semillerista.proyectos', $rol, new Proyecto());
        $persona = DB::table('personas')->where('usuario', $user->id)->first();
        $semillerista = Semillerista::findOrFail($persona->num_identificacion);
        $int_proyectos =  DB::table('integrantes_proy')->where('semillerista', $persona->num_identificacion)->get(); 
        $proyectos = collect(); // Inicializar una colección vacía
    
        foreach ($int_proyectos as $int_proyecto) {
            $proyecto = Proyecto::find($int_proyecto->proyecto); // Buscar cada proyecto
            if ($proyecto) {
                $proyectos->push($proyecto); // Agregar proyecto a la colección
            }
        }
            
        return view('proyectos', compact('proyectos', 'user'));
    }

}
