<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Coordinador\CoordinadorController;
use App\Http\Controllers\ReportController;

Route::get('', [CoordinadorController::class, 'index'])->name("coordinador.home");
Route::get('vista/editar_semillero/{id}', [CoordinadorController::class, 'editarSemillero'])->name('vista_editar_semillero_cor');
Route::post('vista/actualizar_semillero/{id}', [CoordinadorController::class, 'actualizarSemillero'])->name('actualizar_semillero_cor');
Route::get('/semillero/semilleristas', [CoordinadorController::class, 'verSemilleristas'])->name('listado_Semilleristas_cor');
Route::get('/desvincular_sem_sem/{num_identificacion}', [CoordinadorController::class, 'desvincularSemillero'])->name('desvincular_sem_sem_cor');

//rutas de usuarios
Route::get('/proyectos', [CoordinadorController::class,'listarProyectos'])->name('proyectos');

//Agregar
Route::get('/vista/agregar-proyectos', [CoordinadorController::class,'vistaAgrProyectos'])->name('vista_agr_proy');
Route::post('/vista/agregar-proyectos', [CoordinadorController::class,'agregarProyecto'])->name('agregar_proyecto');

//Editar
Route::get('/vista/editar_proyectos/{id}', [CoordinadorController::class, 'vistaEditProyectos'])->name('edit_proyectos');
Route::post('/vista/editar_proyectos/{id}', [CoordinadorController::class, 'editarProyectos'])->name('editar_proyecto');

//Eliminar
Route::get('/eliminar_proyectos/{id}', [CoordinadorController::class, 'eliminarProyecto'])->name('eliminar_proyecto');
Route::get('/eliminar_proyecto/{id}', [CoordinadorController::class, 'confirmacionEliminacionProyecto']);

//Vincular Semillerista
Route::get('vista/vincular_proyecto/{num_identificacion}', [CoordinadorController::class, 'vistaVincularProyecto'])->name('vista_proyectos_vincular');
Route::get('vista/add_semillerista_proyecto/{num_identificacion}', [CoordinadorController::class, 'addSemProyecto'])->name('add_sem_proyecto');
Route::get('vista/vincular_sem_proy/{num_identificacion}/{id_proyecto}', [CoordinadorController::class, 'vincularSemProyecto'])->name('vincular_sem_proyecto');

//Desvincular Semillerista Proyecto
Route::get('/desvincular_sem_proy/{num_identificacion}/{id_proyecto}', [CoordinadorController::class, 'desvincularProyecto'])->name('desvincular_sem_proy');

//Vincular Proyecto Evento
Route::get('vista/vincular_proyecto_evento/{id_proyecto}', [CoordinadorController::class, 'vistaVincularProyectoEvento'])->name('vista_proy_evento_vincular');
Route::get('vista/add_proyecto_evento/{id_proyecto}', [CoordinadorController::class, 'addProyectoEvento'])->name('add_proyecto_evento');
Route::get('vista/vincular_proy_evento/{id_proyecto}/{codigo_evento}', [CoordinadorController::class, 'vincularProyectoEvento'])->name('vincular_proyecto_evento');

//Desvincular Proyecto Evento
Route::get('/desvincular_proy_evento/{id_proyecto}/{codigo_evento}', [CoordinadorController::class, 'desvincularProyectoEvento'])->name('desvincular_proy_evento');

// Route::get('vista/proyectos_vinculados_evento/{codigo_evento}', [CoordinadorController::class, 'vistaProyectoEventoVinculado'])->name('vista_proy_vinculado_evento');

//Generar reporte semillero
Route::get('/reporte_semillero', [ReportController::class, 'generarReporteSemillero_coor'])->name('sem_report_coor');
//Generar reporte semilleristas
Route::get('/reporte_semilleristas', [ReportController::class, 'generarReporteSemilleristas'])->name('reporte_semilleristas');

//agregar participantes de semillero
Route::get('/agregar_participantes', [CoordinadorController::class, 'agregarParticipantes'])->name('agregar_participantes_semillero');
Route::get('/agregar_participante/{documento}', [CoordinadorController::class, 'vincularParticipante'])->name('vincular_sem');

//Generar reporte proyectos
Route::get('/reporte_proyectosC', [ReportController::class, 'generarReporteProyectosC'])->name('proyectosC_report');
Route::get('/reporte_proyectosCI/{id}', [ReportController::class, 'generarReporteProyectosIndividuaCI'])->name('proyectosCI_report');