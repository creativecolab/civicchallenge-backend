<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
	const PHASE_ONE = 0;
	const PHASE_TWO = 1;
	const PHASE_THREE = 2;
	const PHASE_FOUR = 3;

	const PHASE_START = 0;
	const PHASE_END = 3;

	protected $fillable = [
		'name',
		'summary',
		'description',
		'thumbnail',
		'phase'
	];
}
