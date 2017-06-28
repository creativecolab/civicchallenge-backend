<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model {
	use CrudTrait;

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
		'long_description',
		'thumbnail',
		'phase',
		'category_id'
	];

	public function resources() {
		return $this->hasMany('App\Resource');
	}

	public function category() {
		return $this->belongsTo('App\Category');
	}

	public function questions() {
		return $this->hasMany('App\Question');
	}

	public function insights() {
		return $this->hasMany('App\Insight');
	}

	public function channels() {
		return $this->hasMany('App\Channel');
	}
}
