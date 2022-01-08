<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;




class LoginController extends Controller
{

	//valida o login
	public function validaLogin(Request $request)
	{
		$usuarioNome = $request->usuario;
		$senha = $request->senha;
		if ($usuarioNome && $senha) {

			$query = Usuario::query();
			$query->where('nome', '=', $usuarioNome);
			$usuarios = $query->first();


			if ($usuarios == null) {

				$senhaBanco = "";
			} else {

				$senhaBanco = $usuarios->senha;
			}

			if (Hash::check($senha, $senhaBanco)) {
				Session::put('login', 'logado');
				return redirect('/tareffo/inicio');
			} else {

				Session::put('msg', ' Usuário e/ou senha incorreta');
				return redirect('/tareffo/login');
			}
		}
	}

	//desloga o usuario
	public function Logout()
	{
		Session::forget('msg');
		Session::forget('login');
		return redirect('/tareffo/login');
	}

}
