<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Storage;

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
	 * @response(200, body={"data":{{"id":1,"slack_id":"UrH6vj8","name":"Wilma Hickle","email":"kallie68@example.org","thumbnail":null,"admin":0,"created_at":"2017-06-13 17:57:56","updated_at":"2017-06-13 17:57:56"}}})
	 * @parameter("include", type="string", description="Relations to include", members={
	 *      @member(value="challenge"),
	 * }),
	 */
	public function index() {
		return User::all();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param $id
	 *
	 * @return User
	 * @get("/{id}")
	 * @response(200, body={"data":{"id":1,"slack_id":"UuwXqgS","name":"Lambert Feest","email":"uwintheiser@example.com","thumbnail":null,"admin":0,"survey":"","created_at":"2017-06-19 20:06:49","updated_at":"2017-06-19 20:13:45"}})
	 * @parameters({
	 *      @parameter("id", description="ID of User OR Slack ID of user", required=true, type="integer|string"),
	 *      @parameter("include", type="string", description="Relations to include", members={
	 *          @member(value="challenge"),
	 *      }),
	 * })
	 */
	public function show( $id ) {
		return User::findBySlackOrUserID( $id );
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
	 * @response(200, body={"data":{"id":1,"slack_id":"UuwXqgS","name":"Lambert Feest","email":"uwintheiser@example.com","thumbnail":null,"admin":0,"survey":"","created_at":"2017-06-19 20:06:49","updated_at":"2017-06-19 20:13:45"}})
	 * @parameters({
	 *      @parameter("id", description="ID of User OR Slack ID of user", required=true, type="integer|string"),
	 * })
	 */
	public function update( UserRequest $request, $id ) {
		$user = User::findBySlackOrUserID( $id );

		if ( ! $user->update( $request->all() ) ) {
			$this->response->errorInternal();
		}

		return $user;
	}

	public function uploadThumbnail( Request $request, $id ) {
		$user = User::findBySlackOrUserID( $id );

		if ( ! $request->hasFile( 'thumbnail' ) ) {
			$this->response->errorBadRequest();
		}

		$file = $request->file( 'thumbnail' );
		$filename = uniqid( $user->id ) . '.' . $file->getClientOriginalExtension();

		$data['thumbnail'] = $file->storeAs( 'users/thumbnails', $filename, 'public' );

		if ( ! $user->update( $data ) ) {
			$this->response->errorInternal();
		}

		return $user;
	}
}
