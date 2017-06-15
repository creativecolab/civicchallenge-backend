<?php

namespace App\Http\Controllers;

use App\Challenge;
use App\Http\Requests\Api\GetInsightRequest;
use App\Insight;
use DB;
use Illuminate\Http\Request;

/**
 * Insights i.e. Discussion, comments, prototypes, ideas
 * @package App\Http\Controllers
 * @resource("Insights", uri="/insights")
 */
class InsightController extends Controller {
	use CreatesInsights;

	/**
	 * Display a listing of the resource.
	 *
	 * @param GetInsightRequest $request
	 *
	 * @return \Illuminate\Support\Collection
	 * @get("/{?types,challenge,phase}")
	 * @response(200)
	 * @parameters({
	 *     @parameter("types", type="array|number", description="Filter by type (0 = NORMAL, 1 = CURATED, 2 = HIGHLIGHT)"),
	 *     @parameter("challenge", type="number", description="Get insights from challenge ID."),
	 *     @parameter("phase", type="number", description="Get insights from specific phase"),
	 * })
	 */
	public function index(GetInsightRequest $request) {
		$types = explode(',', $request->get('types'));
		$challenge = $request->get('challenge');
		$phase = $request->get('phase');

		$insights = DB::table('insights');

		if (!empty($types)) {
			$insights = $insights->whereIn('type', $types);
		}

		if ($challenge) {
			$insights = $insights->where('challenge_id', '=', $challenge);
		}

		if (isset($phase)) {
			$insights = $insights->where('phase', '=', $phase);
		}

		return $insights->get();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return Insight|bool|\Dingo\Api\Http\Response
	 *
	 * @post("/")
	 * @transaction({
	 *     @request({"text": "Eos ipsa possimus nemo voluptas facilis in.","user_id": 1,"timestamp": "1999-01-31 00:00:00","thumbnail": "http://lorempixel.com/640/480/?44834","type": 0,"question_id": 1,"challenge_id": 1,"slack_meta": {"var1": "content"}}),
	 *     @request({"insights": {}}),
	 *     @response(200, body={"insight":{"text":"Eos ipsa possimus nemo voluptas facilis in.","user_id":1,"timestamp":"1999-01-31 00:00:00","thumbnail":"http:\/\/lorempixel.com\/640\/480\/?44834", "type": 0,"question_id":1,"challenge_id":1,"slack_meta":"","phase":0,"updated_at":"2017-05-31 19:58:08","created_at":"2017-05-31 19:58:08","id":1261}}),
	 *     @response(204)
	 * })

	 */
	public function store( Request $request ) {
		if (is_array($request->get('insights'))) {
			if ($this->createInsights($request)) {
				return $this->response->noContent();
			}
			else {
				$this->response->errorInternal();
			}
		}

		return $this->createInsight($request, Challenge::findOrFail($request->get('challenge_id')));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Insight $insight
	 *
	 * @return Insight
	 *
	 * @get("/{id}")
	 * @response(200, body={"insight":{"text":"Eos ipsa possimus nemo voluptas facilis in.","user_id":1,"timestamp":"1999-01-31 00:00:00","thumbnail":"http:\/\/lorempixel.com\/640\/480\/?44834", "type": 0,"question_id":1,"challenge_id":1,"slack_meta":"","phase":0,"updated_at":"2017-05-31 19:58:08","created_at":"2017-05-31 19:58:08","id":1261}}) @parameters({
	 *     @parameter("id", description="ID of Insight", required=true, type="integer")
	 * })
	 */
	public function show( Insight $insight ) {
		return $insight;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Insight $insight
	 *
	 * @return Insight
	 *
	 * @put("/{id}")
	 * @patch("/{id}")
	 * @request({"type": 1})
	 * @response(200, body={"insight":{"text":"Eos ipsa possimus nemo voluptas facilis in.","user_id":1,"timestamp":"1999-01-31 00:00:00","thumbnail":"http:\/\/lorempixel.com\/640\/480\/?44834","type": 1,"question_id":1,"challenge_id":1,"slack_meta":"","phase":0,"updated_at":"2017-05-31 19:58:08","created_at":"2017-05-31 19:58:08","id":1261}})
	 * @parameters({
	 *     @parameter("id", description="ID of Insight", required=true, type="integer")
	 * })
	 */
	public function update( Request $request, Insight $insight ) {
		if ( ! $insight->update( $request->all() ) ) {
			$this->response->errorInternal();
		}

		return $insight;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Insight $insight
	 *
	 * @return \Illuminate\Http\Response
	 *
	 * @delete("/{id}")
	 * @response(204)
	 * @parameters({
	 *     @parameter("id", description="ID of Insight", required=true, type="integer")
	 * })
	 */
	public function destroy( Insight $insight ) {
		if ( ! $insight->delete() ) {
			$this->response->errorInternal();
		}

		return $this->response->noContent();
	}
}
