<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'text',
	    'challenge_id',
	    'phase'
    ];

    public function challenge() {
    	return $this->belongsTo('App\Challenge');
    }
}
