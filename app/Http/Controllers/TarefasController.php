<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CriadorDeTarefa;
use App\Models\Tarefa;
use App\Models\Empresa;
use App\Models\Historico;
use App\Models\Anexo;
use App\Models\Json;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;



class TarefasController extends Controller
{

	//chama a tela de tarefas
	public function indexTarefas()
	{
		if (session()->has('login')) {

			$empresas = Empresa::all();
			return view('tarefas.index', compact('empresas'));

		} else {
			return view('login.index');
		}
	}

	// chaama o formulario de cadastro de tarefa
	public function create()
	{
		if (session()->has('login')) {

			$empresas = Empresa::all();
			return view('tarefas.create', compact('empresas'));

		} else {
			return redirect('/tareffo/login');
		}

	}

	//crio uma tarefa
	public function store(Request $request, CriadorDeTarefa $criadorTarefa)
	{

		if (session()->has('login')) {

			$criadorTarefa = $criadorTarefa->criarTarefa($request->solicitante, $request->solicitacao, $request->empresa, $request->tipo, $request->status, NOW(), $request->prioridade);
			$tipo = '';
			if ($request->tipo == 'E') {
				$tipo = 'Erro';
			} else {
				$tipo = 'Desenvolvimento';
			};

			/*Mail::send('mail.index', [
				'solicitacao' => $request->solicitacao,
				'empresa'  => $request->empresa,
				'solicitante' => $request->solicitante,
				'tipo' => $tipo
			], function ($mensagem) {
				$mensagem->from('joni.macedo50@gmail.com', 'Joni Macedo');
				$mensagem->to('macedojoni50@gmail.com', 'Joni');
				$mensagem->subject('Nova solicitação');
			});*/
			Session::put('msgTarefa', 'Tarefa cadastrada com sucesso!');
			//Session::put('msgEmail', 'Email enviado com sucesso!');
			return redirect('/tareffo/listarTarefas');

		} else {
			return redirect('/tareffo/login');
		}
	}

	//filtro e listo as tarefas
	public function listTarefas(Request $request)
	{
		if (session()->has('login')) {

			$query = DB::table('tarefas')
				->join('empresas', 'tarefas.empresas_id', '=', 'empresas.id')
				->select(
					'tarefas.id',
					'tarefas.solicitante',
					'tarefas.solicitacao',
					'tarefas.empresas_id',
					'tarefas.tipo',
					'tarefas.status',
					'tarefas.previsao',
					'tarefas.prioridade',
					'tarefas.conclusao',
					'empresas.nome AS empresasNome',
					'empresas.id AS empresasId',
					'empresas.telefone AS empresaTelefone'
				);
			if ($request->has('solicitante')) {
				$query->where('solicitante', 'LIKE', '%' . $request->solicitante . '%');
			}
			if ($request->has('solicitacao')) {
				$query->where('solicitacao', 'LIKE', '%' . $request->solicitacao . '%');
			}
			if ($request->has('empresa')) {
				$query->where('empresas_id', 'LIKE', '%' . $request->empresa . '%');
			}
			if ($request->has('tipo')) {
				$query->where('tipo', 'LIKE', '%' . $request->tipo . '%');
			}
			if ($request->has('status')) {
				$query->where('status', 'LIKE', '%' . $request->status . '%');
			}
			if ($request->has('previsao')) {
				$query->where('previsao', 'LIKE', '%' . $request->previsao . '%');
			}
			if ($request->has('prioridade')) {
				$query->where('prioridade', 'LIKE', '%' . $request->prioridade . '%');
			}
			if ($request->situacao == 'A') {
				$query->where('previsao', '<=', NOW())->where('status', '!=', 'CL');
			}
			if ($request->situacao == 'D') {
				$query->where('previsao', '>', NOW());
			}
			$tarefas = $query->paginate(5);

			return view('tarefas.list', compact('tarefas'));

		} else {
			return redirect('/tareffo/login');
		}
	}

	//carrego a tarefa para ser editada
	public function edit($id)
	{
		if (session()->has('login')) {

			$tarefa = Tarefa::find($id);
			$empresas = Empresa::all();

			return view('tarefas.create', compact('tarefa', 'empresas'));

		} else {
			return redirect('/tareffo/login');
		}
	}

	//edito uma tarefa
	public function update(Request $request, $id)
	{
		if (session()->has('login')) {

			$empresas = Empresa::all();
			$conclusao = NULL;
			if ($request->status == "CL") {

				$conclusao = NOW();
			}
			$tarefa = Tarefa::where('id', '=', $id)->update([
				$tarefa =
					'solicitante' => $request->solicitante,
				'solicitacao' => $request->solicitacao,
				'empresas_id' => $request->empresa,
				'tipo' => $request->tipo,
				'status' => $request->status,
				'previsao' => $request->previsao,
				'prioridade' => $request->prioridade,
				'conclusao' => $conclusao,
			]);
			return view('tarefas.index', compact('empresas'));

		} else {
			return redirect('/tareffo/login');
		}
	}

	//deleta a tarefa
	public function destroyTarefa($id)
	{
		if (session()->has('login')) {

			Tarefa::Find($id)->delete();
			$empresas = Empresa::all();
			Session::put('msgRemoveTarefa', 'Tarefa removida com sucesso!');
			return view('tarefas.index', compact('empresas'));

		} else {
			return redirect('/tareffo/login');
		}
	}

	//adiciona o anexo
	public function adicionarAnexo(Request $request)
	{
		if (session()->has('login')) {

			$extencao = $request->anexo->getClientOriginalExtension();
			//gera um numero unico baseado no timestamp atual
			$nome = uniqid();
			//salva um nome baseado no id
			$nameFile = "{$nome}.{$extencao}";
			// Faz o upload:
			$upload = $request->anexo->storeAs('tarefas', $nameFile);
			//envia o nome do arquivo de uma vez
			Anexo::create([
				'img' => $upload,
				'tarefas_id' => $request->idTarefaAnexo,
			]);
			return redirect('/tareffo/listarTarefas');

		} else {
			return redirect('/tareffo/login');
		}
	}

	//exibe anexo
	public function exibeAnexo(Request $request)
	{
		if (session()->has('login')) {

			$anexos = Anexo::query()->where('tarefas_id', '=', $request->IdExibeAnexo)->get();

			return view('tarefas.listAnexos', compact('anexos'));

		} else {
			return redirect('/tareffo/login');
		}
	}

	//cria o historico
	public function createHistoric(Request $request)
	{
		if (session()->has('login')) {

			if ($request->historico != '') {
				Historico::create([
					'historico' => $request->historico,
					'tarefas_id' => $request->idTarefaHistorico,
					'criacao' => NOW(),
				]);
			}
			$historicos = Historico::query()->where('tarefas_id', '=', $request->idTarefaHistorico)->get();
			return view('tarefas.listHistoric', compact('historicos'));

		} else {
			return redirect('/tareffo/login');
		}
	}

	//testes com api
	public function json()
	{
		return view('json.json');
	}

	public function jsonform(Request $request)
	{
		$testeC = $request->testeC;

		Json::create([
			'json' => $testeC,
		]);
	}

	public function teste()
	{
		$response = Http::get('http://127.0.0.1/api/jsonlist');

		return $response->body();
	}
	public function testeinclusão()
	{


		return view('json.form');
	}
}
