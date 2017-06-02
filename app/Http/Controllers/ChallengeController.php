<?php

namespace App\Http\Controllers;

use App\Challenge;
use Illuminate\Http\Request;

/**
 * Microchallenges
 * @package App\Http\Controllers
 * @resource("Group Challenges")
 */
class ChallengeController extends Controller {
	use CreatesResources, CreatesQuestions;

	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 * @get("/{?resources,questions,insights,groupInsightsByQuestion}")
	 * @parameters({
	 *     @parameter("resources", type="boolean", description="Include associated resources.", default="false"),
	 *     @parameter("questions", type="boolean", description="Include associated questions.", default="false"),
	 *     @parameter("insights", type="boolean", description="Include associated insights.", default="false"),
	 *     @parameter("groupInsightsByQuestion", type="boolean", description="Group associated insights by questions", default="false")
	 * })
	 */
	public function index( Request $request ) {
		$withResources            = strtolower( $request->query( 'resources' ) );
		$withQuestions            = strtolower( $request->query( 'questions' ) );
		$withInsights             = strtolower( $request->query( 'insights' ) );
		$groupInsightsByQuestion = strtolower( $request->query( 'groupInsightsByQuestion' ) );

		$loadRelations = [ 'category' ];

		if ( $withResources == 'true' || $withResources == '1' ) {
			$loadRelations[] = 'resources';
		}

		if ( $withQuestions == 'true' || $withQuestions == '1' ) {
			$loadRelations[] = 'questions';
		}

		if ( $withInsights == 'true' || $withInsights == '1' ) {
			if ( $groupInsightsByQuestion == 'true' || $groupInsightsByQuestion == '1' ) {
				$loadRelations[] = 'questions.insights';
			} else {
				$loadRelations[] = 'insights';
			}
		}

		$challenges = Challenge::with( $loadRelations )->get();

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
	 * @param Request $request
	 * @param  \App\Challenge $challenge
	 *
	 * @return Challenge|\Illuminate\Http\Response
	 * @get("/{id}{?resources,questions}")
	 * @response(200, body={"challenge":{"id":1,"name":"Consequatur voluptatem atque blanditiis.","summary":"In vel eaque ut reprehenderit voluptates.","thumbnail":"http://thumbnail.com/img.jpg","phase":2,"created_at":"2017-05-31 05:06:00","updated_at":"2017-05-31 05:06:00"}})
	 * @parameters({
	 *     @parameter("id", description="ID of Challenge", required=true, type="integer"),
	 * 	   @parameter("resources", type="boolean", description="Include associated resources.", default="false"),
	 *     @parameter("questions", type="boolean", description="Include associated questions.", default="false")
	 * })
	 */
	public function show( Request $request, Challenge $challenge ) {
		$challenge->load( [ 'category' ] );

		$withResources = strtolower( $request->query( 'resources' ) );
		$withQuestions = strtolower( $request->query( 'questions' ) );

		$loadRelations = [ 'category' ];

		if ( $withResources == 'true' || $withResources == '1' ) {
			$loadRelations[] = 'resources';
		}

		if ( $withQuestions == 'true' || $withQuestions == '1' ) {
			$loadRelations[] = 'questions';
		}

		$challenge->load( $loadRelations );

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

	/**
	 * Get Questions belonging to Challenge
	 *
	 * @param Request $request
	 * @param Challenge $challenge
	 *
	 * @return mixed
	 * @get("/{id}/questions/{?insights}")
	 * @response(200)
	 * @parameters({
	 *     @parameter("id", description="ID of Challenge", required=true, type="integer"),
	 *     @parameter("insights", description="Include associated insights.", type="boolean")
	 * })
	 */
	public function showQuestions( Request $request, Challenge $challenge ) {
		$withInsights = strtolower( $request->query( 'insights' ) );

		if ( $withInsights == 'true' || $withInsights == '1' ) {
			return $challenge->questions()->with( 'insights' )->get();
		}

		return $challenge->questions;
	}

	/**
	 * Store new Question for Challenge
	 *
	 * @param Request $request
	 * @param Challenge $challenge
	 *
	 * @return \App\Question
	 *
	 * @post("/{id}/questions")
	 * @request({"text": "What?"})
	 * @response(200, body={"question":{"id":1,"text":"What?","challenge_id":1,"phase":1,"created_at":"2017-05-31 17:00:27","updated_at":"2017-05-31 17:18:28"}})
	 * @parameters({
	 *     @parameter("id", description="ID of Challenge", required=true, type="integer")
	 * })
	 */
	public function storeQuestion( Request $request, Challenge $challenge ) {
		return $this->createQuestion( $request, $challenge );
	}

	/**
	 * Get Insights for Challenge
	 *
	 * @param Request $request
	 * @param Challenge $challenge
	 *
	 * @return mixed
	 *
	 * @get("/{id}/insights")
	 * @response(200, body={"insights": {}})
	 * @parameters({
	 *     @parameter("id", description="ID of Challenge", required=true, type="integer")
	 * })
	 */
	public function showInsights( Request $request, Challenge $challenge ) {
		return $challenge->insights;
	}
}
