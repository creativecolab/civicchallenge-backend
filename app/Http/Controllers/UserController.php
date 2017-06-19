<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * Users
 * @package App\Http\Controllers
 * @resource("Users", uri="/users")
 */
class UserController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 *
	 * @get("/")
	 * @response(200, body={"users":{{"id":1,"slack_id":"UrH6vj8","name":"Wilma Hickle","email":"kallie68@example.org","thumbnail":null,"admin":0,"created_at":"2017-06-13 17:57:56","updated_at":"2017-06-13 17:57:56"}}})
	 */
	public function index() {
		return User::all();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param UserRequest|Request $request
	 * @param $id
	 *
	 * @return User
	 *
	 * @put("/{id}")
	 * @post("/{id}")
	 * @request({"survey": ""})
	 * @response(200, body={"user":{"id":1,"slack_id":"UuwXqgS","name":"Lambert Feest","email":"uwintheiser@example.com","thumbnail":null,"admin":0,"survey":"","created_at":"2017-06-19 20:06:49","updated_at":"2017-06-19 20:13:45"}})
	 * @parameters({
	 *      @parameter("id", description="ID of User OR Slack ID of user", required=true, type="integer|string"),
	 * })
	 */
	public function update( UserRequest $request, $id ) {
		$user = $this->findBySlackOrUserID($id);

		if ( ! $user->update( $request->all() ) ) {
			$this->response->errorInternal();
		}

		return $user;
	}

	protected function findBySlackOrUserID($id) {
		// Try to find by user ID first and then try Slack ID
		try {
			$user = User::findOrFail($id);
		}
		catch (ModelNotFoundException $e) {
			$user = User::where('slack_id', '=', $id)->firstOrFail();
		}

		return $user;
	}
}
