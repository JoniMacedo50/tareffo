<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\TarefasController;
use App\Http\Controllers\EmpresasController;






Route::get('/json', [TarefasController::class, 'json']);
Route::post('/json', [TarefasController::class, 'jsonform'])->name('json.json');
Route::get('/jsonlist', [TarefasController::class, 'teste']);


//rotas de login e logout
Route::get('/', function () {
    return redirect('tareffo/login');
});


Route::get('/tareffo', function () {
    return redirect('/tareffo/login');
});

Route::get('/tareffo/login', function () {
    return view('login.index');
});

Route::post('/tareffo/login', [LoginController::class, 'validaLogin'])->name('valida.login');
Route::get('/tareffo/inicio', [InicioController::class, 'inicio'])->name('inicio');
Route::get('/tareffo/logout', [LoginController::class, 'logout']);
Route::get('/tareffo/agenda', [InicioController::class, 'agenda']);
//rotas de usuarios
Route::get('/tareffo/listaUsuarios', function () {
    if (session()->has('login')) {
        return view('usuarios.index');
    } else {
        return view('login.index');
    }
});
Route::get('/tareffo/filtrarUsuario', [UsuariosController::class, 'listUsuarios'])->name('usuarios.filtrar');
Route::get('/tareffo/cadastrarUsuario', [UsuariosController::class, 'createUusuario'])->name('cadastra.usuario');
Route::post('/tareffo/cadastrarUsuario', [UsuariosController::class, 'storeUsuario']);
Route::get('/tareffo/{id}/editUsuario', [UsuariosController::class, 'editUsuario']);
Route::any('/tareffo/{id}/usuario', [UsuariosController::class, 'updateUsuario']);
Route::delete('/tareffo/deleteUsuario/{id}', [UsuariosController::class, 'destroyUsuario']);

//rotas de tarefas
Route::get('/tareffo/listarTarefas', [TarefasController::class, 'indexTarefas'])->name('tarefas.listar');
Route::get('/tareffo/filtrarTarefa', [TarefasController::class, 'listTarefas'])->name('tarefas.filtrar');
Route::get('/tareffo/cadastrarTarefa', [TarefasController::class, 'create']);
Route::post('/tareffo/cadastrarTarefa', [TarefasController::class, 'store']);
Route::get('/tareffo/{id}/editTarefa', [TarefasController::class, 'edit']);
Route::any('/tareffo/{id}/tarefa', [TarefasController::class, 'update']);
Route::delete('/tareffo/deleteTarefa/{id}', [TarefasController::class, 'destroyTarefa']);
Route::get('/tareffo/cadastraHistorico', [TarefasController::class, 'createHistoric'])->name('tarefas.historico');
Route::post('/tareffo/anexoTarefas', [TarefasController::class, 'adicionarAnexo'])->name('adicionar.anexo');
Route::get('/tareffo/anexoTarefas', [TarefasController::class, 'exibeAnexo'])->name('exibir.anexo');


//rotas de empresas
Route::get('/tareffo/listaEmpresas', function () {
    if (session()->has('login')) {
        return view('empresas.index');
    } else {
        return view('login.index');
    }
});
Route::get('/tareffo/filtrarEmpresa', [EmpresasController::class, 'listEmpresa'])->name('empresas.filtrar');
Route::get('/tareffo/cadastrarEmpresa', [EmpresasController::class, 'createEmpresa']);
Route::post('/tareffo/cadastrarEmpresa', [EmpresasController::class, 'storeEmpresa']);
Route::get('/tareffo/{id}/editEmpresa', [EmpresasController::class, 'editEmpresa']);
Route::any('/tareffo/{id}/empresa', [EmpresasController::class, 'updateEmpresa']);
