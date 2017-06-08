<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model {
	use CrudTrait;

	protected $fillable = [
		'name',
		'url',
		'description',
		'type',
		'challenge_id',
		'phase'
	];

	public function challenge() {
		return $this->belongsTo( 'App\Challenge' );
	}
}
