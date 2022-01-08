<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Json extends Model
{

	protected $table = 'json';
	public $timestamps = false;
	protected $primaryKey = 'id';
    protected $fillable = ['json'];

}
