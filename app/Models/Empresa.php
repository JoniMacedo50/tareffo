<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{

	protected $table = 'empresas';
	public $timestamps = false;
	protected $primaryKey = 'id';
	protected $fillable = ['nome', 'telefone', 'criacao'];

	public function terefas(){

		return $this->hasMany(Tarefa::class);
	}
}
