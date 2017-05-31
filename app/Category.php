<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
	protected $fillable = [
		'name',
		'description'
	];

	public function challenges() {
    	return $this->hasMany('App\Challenge');
	}
}
