<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
	protected $fillable = [
		'name',
		'slack_id',
		'challenge_id',
	];

	public function challenge()
	{
    	return $this->belongsTo('App\Challenge');
	}
}
