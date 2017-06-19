<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, CrudTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
	    'email',
	    'slack_id',
	    'survey',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function insights() {
    	return $this->hasMany('App\Insight');
    }

	public static function findBySlackOrUserID($id) {
		// Try to find by user ID first and then try Slack ID
		try {
			$user = static::findOrFail($id);
		}
		catch (ModelNotFoundException $e) {
			$user = static::where('slack_id', '=', $id)->firstOrFail();
		}

		return $user;
	}
}
