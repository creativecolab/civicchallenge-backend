<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
	protected $fillable = [
		'name',
		'summary'
	];
}
