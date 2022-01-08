<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Json;
use App\Http\Controllers\Controller;


class JsonController extends Controller
{

	public function jsonlist()
	{
		$data = Json::all();
		return response()->json($data);
	}

	public function show(Json $id)
	{
		try {

			
			return response()->json($id);

		} catch (\Exception) {
			$json = Json::find($id);
			if (!$json) {

				return response()->json(['msg' => 'Houve um erro ao realizar a operação, registro não encontrado'], 404);
			}

		}
	}

	public function store(Request $request)
	{
		try {

			$jsonData = $request->all();
			Json::create($jsonData);

			return response()->json(['msg' => 'Cadastro realizado com sucesso!'], 201);
		} catch (\Exception) {
			if (config('app.debug')) {

				return response()->json(['msg' => 'Houve um erro ao realizar a operação'], 1010);
			}
		}
	}
	public function update(Request $request, $id)
	{
		try {

			$jsonData = $request->all();
			$json = Json::find($id);
			$json->update($jsonData);

			return response()->json(['msg' => 'Atualizado com sucesso!'], 201);
		} catch (\Exception) {
			if (config('app.debug')) {

				return response()->json(['msg' => 'Houve um erro ao realizar a operação'], 1011);
			}
		}
	}
	public function delete(Json $id)
	{
		try {

				$id->delete();

			return response()->json(['msg' => 'Removido com sucesso!'], 201);
		} catch (\Exception) {
			if (config('app.debug')) {

				return response()->json(['msg' => 'Houve um erro ao realizar a operação'], 1012);
			}
		}
	}
}
