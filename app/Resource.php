<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model {
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
