<?php

namespace App\Services;

use App\Models\Tarefa;

class CriadorDeTarefa
{

	public function criarTarefa(string $solicitante, string $solicitacao, string $empresa, string $tipo,  string $status, string $previsao,  string $prioridade): Tarefa
	{


		$tarefa = Tarefa::create([
			'solicitante' => $solicitante,
			'solicitacao' => $solicitacao,
			'empresas_id' => $empresa,
			'tipo' => $tipo,
			'status' => $status,
			'previsao' => $previsao,
			'prioridade' => $prioridade
		]);


		return $tarefa;
	}
}
