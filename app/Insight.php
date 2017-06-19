<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Insight extends Model
{
	use CrudTrait;

	const TYPE_NORMAL = 0;
	const TYPE_CURATED = 1;
	const TYPE_HIGHLIGHT = 2;

	const TYPE_DEFAULT = 0;
	const TYPE_MIN = 0;
	const TYPE_MAX = 2;

    protected $fillable = [
		'text',
	    'user_id',
	    'channel_id',
	    'timestamp',
	    'thumbnail',
	    'type',
	    'question_id',
	    'challenge_id',
	    'phase',
	    'slack_meta'
    ];

    public function question() {
    	return $this->belongsTo('App\Question');
    }

    public function challenge() {
    	return $this->belongsTo('App\Challenge');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
