<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{

	protected $table = 'tarefas';
	public $timestamps = false;
	protected $primaryKey = 'id';
	protected $fillable = ['solicitante', 'solicitacao', 'empresas_id', 'tipo', 'status', 'previsao', 'prioridade', 'conclusao'];
	
	public function empresa(){

		return $this->belongsTo(Empresa::class);
	}
}


