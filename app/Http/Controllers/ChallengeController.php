<?php

namespace App\Http\Controllers;

use App\Challenge;
use Illuminate\Http\Request;

/**
 * Microchallenges
 * @package App\Http\Controllers
 * @resource("Challenges", uri="/challenges")
 */
class ChallengeController extends Controller {
	use CreatesResources;

	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 * @get("/{?resources}")
	 * @parameters({
	 *     @parameter("resources", type="boolean", description="Include associated resources.", default="false")
	 * })
	 */
	public function index( Request $request ) {
		$withResources = strtolower( $request->query( 'resources' ) );

		if ( $withResources == 'true' || $withResources == '1' ) {
			$challenges = Challenge::with( [ 'category', 'resources' ] )->get();
		} else {
			$challenges = Challenge::with( [ 'category' ] )->get();
		}

		return $challenges;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 *
	 * @post("/")
	 * @request({"name": "Name", "summary": "This is a challenge.", "description": "Challenge description"})
	 * @response(200, body={"challenge":{"id":1,"name":"Consequatur voluptatem atque blanditiis.","summary":"In vel eaque ut reprehenderit voluptates.","thumbnail":"http://thumbnail.com/img.jpg","phase":2,"created_at":"2017-05-31 05:06:00","updated_at":"2017-05-31 05:06:00"}})
	 */
	public function store( Request $request ) {
		return Challenge::create( $request->all() );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Challenge $challenge
	 *
	 * @return Challenge|\Illuminate\Http\Response
	 *
	 * @get("/{id}")
	 * @response(200, body={"challenge":{"id":1,"name":"Consequatur voluptatem atque blanditiis.","summary":"In vel eaque ut reprehenderit voluptates.","thumbnail":"http://thumbnail.com/img.jpg","phase":2,"created_at":"2017-05-31 05:06:00","updated_at":"2017-05-31 05:06:00"}})
	 * @parameters({
	 *     @parameter("id", description="ID of Challenge", required=true, type="integer")
	 * })
	 */
	public function show( Challenge $challenge ) {
		$challenge->load( [ 'category' ] );

		return $challenge;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Challenge $challenge
	 *
	 * @return Challenge
	 *
	 * @put("/{id}")
	 * @patch("/{id}")
	 * @request({"name": "Name", "summary": "This is a challenge.", "description": "Challenge description"})
	 * @response(200, body={"challenge":{"id":1,"name":"Consequatur voluptatem atque blanditiis.","summary":"In vel eaque ut reprehenderit voluptates.","thumbnail":"http://thumbnail.com/img.jpg","phase":2,"created_at":"2017-05-31 05:06:00","updated_at":"2017-05-31 05:06:00"}})
	 * @parameters({
	 *     @parameter("id", description="ID of Challenge", required=true, type="integer")
	 * })
	 */
	public function update( Request $request, Challenge $challenge ) {
		if ( ! $challenge->update( $request->all() ) ) {
			$this->response->errorInternal();
		}

		$challenge->load( 'category' );

		return $challenge;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Challenge $challenge
	 *
	 * @return \Illuminate\Http\Response
	 *
	 * @delete("/{id}")
	 * @response(204)
	 * @parameters({
	 *     @parameter("id", description="ID of Challenge", required=true, type="integer")
	 * })
	 */
	public function destroy( Challenge $challenge ) {
		if ( ! $challenge->delete() ) {
			$this->response->errorInternal();
		}

		return $this->response->noContent();
	}

	/**
	 * Get Resources belonging to Challenge
	 *
	 * @param Challenge $challenge
	 *
	 * @return mixed
	 *
	 * @get("/{id}/resources")
	 * @response(200, body={"resource":{"name":"Test","url":"http:\/\/test.com","description":"Test description","type":"PDF","phase":2,"challenge_id":1,"updated_at":"2017-05-31 06:33:25","created_at":"2017-05-31 06:33:25","id":23}})
	 * @parameters({
	 *     @parameter("id", description="ID of Challenge", required=true, type="integer")
	 * })
	 */
	public function showResources( Challenge $challenge ) {
		return $challenge->resources;
	}

	/**
	 * Store new Resource for Challenge
	 *
	 * @param Request $request
	 * @param Challenge $challenge
	 *
	 * @return \App\Resource
	 *
	 * @post("/{id}/resources")
	 * @request({"name": "Test","url": "http://test.com","description": "Test description","type": "PDF"})
	 * @response(200, body={"resource":{"name":"Test","url":"http:\/\/test.com","description":"Test description","type":"PDF","phase":2,"challenge_id":1,"updated_at":"2017-05-31 06:33:25","created_at":"2017-05-31 06:33:25","id":23}})
	 * @parameters({
	 *     @parameter("id", description="ID of Challenge", required=true, type="integer")
	 * })
	 */
	public function storeResource( Request $request, Challenge $challenge ) {
		return $this->createResource( $request, $challenge );
	}
}
