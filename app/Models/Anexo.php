<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{

	protected $table = 'anexos';
	public $timestamps = false;
	protected $fillable = ['tarefas_id', 'img'];
	
}


