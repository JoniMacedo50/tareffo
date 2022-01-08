<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{

	protected $table = 'historicos';
	public $timestamps = false;
	protected $primaryKey = 'id';
	protected $fillable = ['historico', 'tarefas_id', 'criacao'];
}
