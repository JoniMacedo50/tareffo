<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarefa;
use App\Models\Empresa;
use Illuminate\Support\Facades\Session;

class EmpresasController extends Controller
{

	//chama o form de criação de empresa
	public function createEmpresa()
	{
		if (session()->has('login')) {
			return view('empresas.create');
		} else {
			return redirect('/tareffo/login');
		}
	}

	//cria a empresa
	public function storeEmpresa(Request $request)
	{

		if (session()->has('login')) {

			Empresa::create([
				'nome' => $request->nome,
				'telefone' => $request->telefone,
				'criacao' => NOW(),
			]);

			return redirect('/tareffo/listaEmpresas');
		} else {
			return redirect('/tareffo/login');
		}
	}

	// lista e filtra a empresa
	public function listEmpresa(Request $request)
	{
		if (session()->has('login')) {
			$query = Empresa::query();

			if ($request->has('nome')) {
				$query->where('nome', 'LIKE', '%' . $request->nome . '%');
			}
			if ($request->has('telefone')) {
				$query->where('telefone', 'LIKE', '%' . $request->telefone . '%');
			}

			$empresas = $query->paginate(5);

			return view('empresas.list', compact('empresas'));
		} else {
			return redirect('/tareffo/login');
		}
	}

	//chama o formulario de logim para editar a empresa
	public function editEmpresa($id)
	{
		if (session()->has('login')) {
			$empresa = Empresa::find($id);
			$tarefas = Tarefa::query()->where('empresas_id', $id)->get();
			return view('empresas.create', compact('empresa', 'tarefas'));
		} else {
			return redirect('/tareffo/login');
		}
	}

	//edita a empresa
	public function updateEmpresa(Request $request, $id)
	{
		if (session()->has('login')) {
			$empresas = Empresa::all();
			$tarefa = Empresa::where('id', '=', $id)->update([
				$tarefa =
					'nome' => $request->nome,
				'telefone' => $request->telefone,
			]);
			return view('empresas.index', compact('empresas'));
		} else {
			return redirect('/tareffo/login');
		}
	}

}
