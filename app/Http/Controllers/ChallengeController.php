<?php

namespace App\Http\Controllers;

use App\Challenge;
use App\Http\Requests\Api\GetChallengeRequest;
use DB;
use Illuminate\Http\Request;

/**
 * Microchallenges
 * @package App\Http\Controllers
 * @resource("Challenges", uri="/challenges")
 */
class ChallengeController extends Controller {
	use CreatesResources, CreatesQuestions;

	/**
	 * Display a listing of the resource.
	 *
	 * @param GetChallengeRequest $request
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 * @get("/{?phase,allPhases,resources,questions,insights,insightTypes,groupInsightsByQuestion}")
	 * @parameters({
	 *     @parameter("phase", type="number", description="Get challenges from specific phase."),
	 *     @parameter("allPhases", type="boolean", description="Get relations for each challenge from all phases.", default=0),
	 *     @parameter("resources", type="boolean", description="Include associated resources.", default=0),
	 *     @parameter("questions", type="boolean", description="Include associated questions.", default=0),
	 *     @parameter("insights", type="boolean", description="Include associated insights.", default=0),
	 *     @parameter("insightTypes", type="array|number", description="Filter by type (0 = NORMAL, 1 = CURATED, 2 = HIGHLIGHT)", default="1,2"),
	 *     @parameter("groupInsightsByQuestion", type="boolean", description="Group associated insights by questions", default=0)
	 * })
	 */
	public function index( GetChallengeRequest $request ) {
		$withResources           = $request->get( 'resources' );
		$withQuestions           = $request->get( 'questions' );
		$withInsights            = $request->get( 'insights' );
		$groupInsightsByQuestion = $request->get( 'groupInsightsByQuestion' );
		$allPhases               = $request->get( 'allPhases' );
		$phase                   = $request->get( 'phase' );
		$insightTypes            = explode( ',', $request->get( 'insightTypes', '1,2' ) );

		$loadRelations = [];

		if ( ! $allPhases ) {
			$challenges = Challenge::with('category');

			if ($phase) {
				$challenges->where('phase', '=', $phase);
			}

			$challenges = $challenges->get();

			foreach ( $challenges as $key => $challenge ) {
				$phase = isset($phase) ? $phase : $challenge->phase;

				$phaseFunction = function ( $query ) use ( $phase ) {
					$query->where( 'phase', '=', $phase );
				};

				if ( $withResources ) {
					$loadRelations['resources'] = $phaseFunction;
				}

				if ( $withQuestions ) {
					if ( $withInsights && $groupInsightsByQuestion ) {
						$loadRelations['questions'] = function ( $query ) use ( $phase, $phaseFunction, $insightTypes ) {
							$query->where( 'phase', '=', $phase );
							$query->with( [
								'insights' => function ( $query ) use ( $phase, $phaseFunction, $insightTypes ) {
									if ( ! empty( $insightTypes ) ) {
										$query->whereIn( 'type', $insightTypes );
									}
									return $phaseFunction($query);
								}
							] );
						};
					} else {
						$loadRelations['questions'] = $phaseFunction;
					}
				}

				if ( $withInsights && ! $groupInsightsByQuestion ) {
					if (!empty($insightTypes)) {
						$loadRelations['insights'] = function ($query) use ($phaseFunction, $insightTypes) {
							if ( ! empty( $insightTypes ) ) {
								$query->whereIn( 'type', $insightTypes );
							}
							return $phaseFunction($query);
						};
					}
					else {
						$loadRelations['insights'] = $phaseFunction;
					}
				}

				$challenge->load( $loadRelations );

				$challenges[ $key ] = $challenge;
			}

			return $challenges;

		} else {
			$loadRelations[] = 'category';

			if ( $withResources ) {
				$loadRelations[] = 'resources';
			}

			if ( $withQuestions ) {
				$loadRelations[] = 'questions';
			}

			if ( $withInsights ) {
				if ( $groupInsightsByQuestion ) {
					$insightRelation = 'questions.insights';
				} else {
					$insightRelation = 'insights';
				}

				if ( ! empty( $insightTypes ) ) {
					$loadRelations[ $insightRelation ] = function ( $query ) use ( $insightTypes ) {
						$query->whereIn( 'type', $insightTypes );
					};
				} else {
					$loadRelations[] = $insightRelation;
				}
			}

			return Challenge::with( $loadRelations )->get();
		}
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
	 * @param GetChallengeRequest $request
	 * @param  \App\Challenge $challenge
	 *
	 * @return Challenge|\Illuminate\Http\Response
	 * @get("/{id}{?phase,allPhases,resources,questions,insights,insightTypes,groupInsightsByQuestion}")
	 * @response(200, body={"challenge":{"id":1,"name":"Consequatur voluptatem atque blanditiis.","summary":"In vel eaque ut reprehenderit voluptates.","thumbnail":"http://thumbnail.com/img.jpg","phase":2,"created_at":"2017-05-31 05:06:00","updated_at":"2017-05-31 05:06:00"}})
	 * @parameters({
	 *     @parameter("id", description="ID of Challenge", required=true, type="integer"),
	 *     @parameter("phase", type="number", description="Get relations from specific phase."),
	 *     @parameter("allPhases", type="boolean", description="Get relations from all phases.", default=0),
	 * 	   @parameter("resources", type="boolean", description="Include associated resources.", default=0),
	 *     @parameter("questions", type="boolean", description="Include associated questions.", default=0),
	 *     @parameter("insights", type="boolean", description="Include associated insights.", default=0),
	 *     @parameter("insightTypes", type="array|number", description="Filter by type (0 = NORMAL, 1 = CURATED, 2 = HIGHLIGHT)", default="1,2"),
	 *     @parameter("groupInsightsByQuestion", type="boolean", description="Group associated insights by questions", default=0)
	 * })
	 */
	public function show( GetChallengeRequest $request, Challenge $challenge ) {
		$withResources           = $request->get( 'resources' );
		$withQuestions           = $request->get( 'questions' );
		$withInsights            = $request->get( 'insights' );
		$groupInsightsByQuestion = $request->get( 'groupInsightsByQuestion' );
		$allPhases               = $request->get( 'allPhases' );
		$phase                   = $request->get( 'phase' );
		$insightTypes            = explode( ',', $request->get( 'insightTypes', '1,2' ) );

		$loadRelations = [ 'category' ];

		if ( ! $allPhases ) {
			$phase = isset($phase) ? $phase : $challenge->phase;

			$phaseFunction = function ( $query ) use ( $phase ) {
				$query->where( 'phase', '=', $phase );
			};

			if ( $withResources ) {
				$loadRelations['resources'] = $phaseFunction;
			}

			if ( $withQuestions ) {
				if ( $withInsights && $groupInsightsByQuestion ) {
					$loadRelations['questions'] = function ( $query ) use ( $phase, $phaseFunction, $insightTypes ) {
						$query->where( 'phase', '=', $phase );
						$query->with( [
							'insights' => function ( $query ) use ( $phase, $phaseFunction, $insightTypes ) {
								if ( ! empty( $insightTypes ) ) {
									$query->whereIn( 'type', $insightTypes );
								}
								return $phaseFunction($query);
							}
						] );
					};
				} else {
					$loadRelations['questions'] = $phaseFunction;
				}
			}

			if ( $withInsights && ! $groupInsightsByQuestion ) {
				if (!empty($insightTypes)) {
					$loadRelations['insights'] = function ($query) use ($phaseFunction, $insightTypes) {
						if ( ! empty( $insightTypes ) ) {
							$query->whereIn( 'type', $insightTypes );
						}
						return $phaseFunction($query);
					};
				}
				else {
					$loadRelations['insights'] = $phaseFunction;
				}
			}

		} else {
			if ( $withResources ) {
				$loadRelations[] = 'resources';
			}

			if ( $withQuestions ) {
				$loadRelations[] = 'questions';
			}

			if ( $withInsights ) {
				if ( $groupInsightsByQuestion ) {
					$insightRelation = 'questions.insights';
				} else {
					$insightRelation = 'insights';
				}

				if ( ! empty( $insightTypes ) ) {
					$loadRelations[ $insightRelation ] = function ( $query ) use ( $insightTypes ) {
						$query->whereIn( 'type', $insightTypes );
					};
				} else {
					$loadRelations[] = $insightRelation;
				}
			}
		}

		return $challenge->load( $loadRelations );
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
