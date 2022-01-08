<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;



class UsuariosController extends Controller
{


	//lista os usuarios
	public function listUsuarios(Request $request)
	{
		if (session()->has('login')) {
			$query = Usuario::query();

			if ($request->has('nome')) {
				$query->where('nome_completo', 'LIKE', '%' . $request->nomeCompleto . '%');
			}

			$usuarios = $query->paginate(5);

			return view('usuarios.list', compact('usuarios'));
		} else {
			return redirect('/tareffo/login');
		}
	}

	//chamo o formulario de cadastro de usuario
	public function createUusuario()
	{
		if (session()->has('login')) {
			return view('usuarios.create');
		} else {
			return redirect('/tareffo/login');
		}
	}

	//cadastro um usuario
	public function storeUsuario(Request $request)
	{
		if (session()->has('login')) {

			$senha = $request->senha;
			$senhaCriptografada = Hash::make($senha);
			Usuario::create([
				'nome_completo' => $request->nomeCompleto,
				'nome' => $request->nomeUsuario,
				'senha' => $senhaCriptografada,
				'criacao' => NOW(),
			]);
			return redirect('/tareffo/listaUsuarios');
		} else {
			return redirect('/tareffo/login');
		}
	}

	//edito uma usuario
	public function editUsuario($id)
	{
		if (session()->has('login')) {
			$usuario = Usuario::find($id);

			return view('usuarios.create', compact('usuario'));
		} else {
			return redirect('/tareffo/login');
		}
	}

	//edito um usuario
	public function updateUsuario(Request $request, $id)
	{
		if (session()->has('login')) {
			$senha = $request->senha;
			$senhaCriptografada = Hash::make($senha);
			$tarefa = Usuario::where('id', '=', $id)->update([
				$usuario =
					'nome_completo' => $request->nomeCompleto,
				'nome' => $request->nomeUsuario,
				'senha' => $senhaCriptografada,
			]);

			return view('usuarios.index');
		} else {
			return redirect('/tareffo/login');
		}
	}
	//deleta o usuario no banco
	public function destroyUsuario($id)
	{
		if (session()->has('login')) {
			Usuario::Find($id)->delete();
			return view('login.index');
		} else {
			return redirect('/tareffo/login');
		}
	}

}
