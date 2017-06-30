<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Channel extends Model
{
	protected $fillable = [
		'name',
		'slack_id',
		'challenge_id',
		'condition',
	];

	public function challenge()
	{
    	return $this->belongsTo('App\Challenge');
	}

	/**
	 * Get questions belonging to a channel's challenge
	 * @return mixed
	 */
	public function questions()
	{
		return $this->challenge->questions();
	}

	public static function findBySlackOrChannelID($id) {
		// Try to find by channel ID first and then try Slack ID
		try {
			$channel = static::findOrFail($id);
		}
		catch (ModelNotFoundException $e) {
			$channel = static::where('slack_id', '=', $id)->firstOrFail();
		}

		return $channel;
	}

	public static function findWithFallback($id) {
		try {
			$channel = static::findBySlackOrChannelID($id);
		}
		catch (ModelNotFoundException $e) {
			$channel = static::where('name', '=', $id)->firstOrFail();
		}

		return $channel;
	}
}
