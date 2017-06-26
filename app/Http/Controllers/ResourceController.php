<?php

namespace App\Http\Controllers;

use App\Challenge;
use App\Resource;
use Illuminate\Http\Request;

/**
 * Resources for Challenges. i.e. Student work, external resources
 * @package App\Http\Controllers
 * @resource("Challenge Resources", uri="/resources")
 */
class ResourceController extends Controller {
	use CreatesResources;

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 *
	 * @get("/{?include}")
	 * @parameter("include", type="string", description="Relations to include", members={
	 *      @member(value="challenge"),
	 * }),
	 */
	public function index() {
		return Resource::all();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \App\Resource
	 *
	 * @post("/")
	 * @request({"name": "Test","url": "http://test.com","description": "Test description","type": "PDF","challenge_id": 1})
	 * @response(200, body={"data":{"name":"Test","url":"http:\/\/test.com","description":"Test description","type":"PDF","phase":2,"challenge_id":1,"updated_at":"2017-05-31 06:33:25","created_at":"2017-05-31 06:33:25","id":23}})
	 */
	public function store( Request $request ) {
		$challenge = Challenge::findOrFail( $request->get( 'challenge_id' ) );

		return $this->createResource( $request, $challenge );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  Resource $resource
	 *
	 * @return Resource
	 *
	 * @get("/{id}{?include}")
	 * @response(200, body={"data":{"name":"Test","url":"http:\/\/test.com","description":"Test description","type":"PDF","phase":2,"challenge_id":1,"updated_at":"2017-05-31 06:33:25","created_at":"2017-05-31 06:33:25","id":23}})
	 * @parameters({
	 *     @parameter("id", description="ID of Resource", required=true, type="integer"),
	 *     @parameter("include", type="string", description="Relations to include", members={
	 *          @member(value="challenge"),
	 *     }),
	 * })
	 */
	public function show( Resource $resource ) {
		return $resource;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  Resource $resource
	 *
	 * @return Resource
	 *
	 * @put("/{id}")
	 * @patch("/{id}")
	 * @request({"name": "Test","url": "http://test.com","description": "Test description","type": "PDF","challenge_id": 1})
	 * @response(200, body={"data":{"name":"Test","url":"http:\/\/test.com","description":"Test description","type":"PDF","phase":2,"challenge_id":1,"updated_at":"2017-05-31 06:33:25","created_at":"2017-05-31 06:33:25","id":23}})
	 * @parameters({
	 *     @parameter("id", description="ID of Resource", required=true, type="integer")
	 * })
	 */
	public function update( Request $request, Resource $resource ) {
		if ( ! $resource->update( $request->all() ) ) {
			$this->response->errorInternal();
		}

		return $resource;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  Resource $resource
	 *
	 * @return \Illuminate\Http\Response
	 *
	 * @delete("/{id}")
	 * @response(204)
	 * @parameters({
	 *     @parameter("id", description="ID of Resource", required=true, type="integer")
	 * })
	 */
	public function destroy( Resource $resource ) {
		if ( ! $resource->delete() ) {
			$this->response->errorInternal();
		}

		return $this->response->noContent();
	}
}
