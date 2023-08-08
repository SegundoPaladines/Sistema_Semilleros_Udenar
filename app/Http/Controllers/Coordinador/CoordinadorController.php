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

class CoordinadorController extends Controller
{
    public function index()
    {
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

        return redirect()->route('vista_editar_semillero', $semilleroData['id_semillero'])->with('registroExitoso', true);
}
}