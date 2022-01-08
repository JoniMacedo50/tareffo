<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{

	protected $table = 'usuarios';
	public $timestamps = false;
	protected $primaryKey = 'id';
	protected $fillable = ['nome_completo', 'nome', 'senha', 'criacao'];
}
