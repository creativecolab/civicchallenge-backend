<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	use CrudTrait;

    protected $fillable = [
        'text',
	    'challenge_id',
	    'phase'
    ];

    public function challenge() {
    	return $this->belongsTo('App\Challenge');
    }

    public function insights() {
    	return $this->hasMany('App\Insight');
    }
}
