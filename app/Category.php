<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
	use CrudTrait;

	protected $fillable = [
		'name',
		'description',
		'thumbnail'
	];

	public function challenges() {
    	return $this->hasMany('App\Challenge');
	}
}
