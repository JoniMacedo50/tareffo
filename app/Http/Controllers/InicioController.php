<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarefa;
use App\Models\Empresa;
use Illuminate\Support\Facades\Session;




class InicioController extends Controller
{

	//inicio
	public function inicio()
	{
		if (session()->has('login')) {
			$tarefas = Tarefa::query()->where('previsao', '<=', NOW())->where('status', '!=', 'CL')->get()->count();

			$empresas = Empresa::query()->limit(5)->orderby('id');

			return view('inicio.inicio', compact('tarefas'));
		} else {
			return redirect('/tareffo/login');
		}
	}

	public function agenda()
	{
		
			return view('tarefas.agenda');
		
	}

}
