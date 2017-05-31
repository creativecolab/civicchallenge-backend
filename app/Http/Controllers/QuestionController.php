<?php

namespace App\Http\Controllers;

use App\Challenge;
use App\Question;
use Illuminate\Http\Request;

/**
 * Discussion Questions
 * @package App\Http\Controllers
 * @resource("Discussion Questions", uri="/questions")
 */
class QuestionController extends Controller {
	use CreatesQuestions;

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 * @internal param Request $request
	 *
	 * @get("/")
	 * @response(200)
	 */
	public function index() {
		return Question::all();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return Question
	 *
	 * @post("/")
	 * @request({"text": "What?", "challenge_id": 1})
	 * @response(200, body={"question":{"id":1,"text":"What?","challenge_id":1,"phase":1,"created_at":"2017-05-31 17:00:27","updated_at":"2017-05-31 17:18:28"}})
	 */
	public function store( Request $request ) {
		$challenge = Challenge::findOrFail( $request->get( 'challenge_id' ) );

		return $this->createQuestion( $request, $challenge );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Question $question
	 *
	 * @return Question
	 *
	 * @get("/{id}")
	 * @response(200, body={"question":{"id":1,"text":"What?","challenge_id":1,"phase":1,"created_at":"2017-05-31 17:00:27","updated_at":"2017-05-31 17:18:28"}})
	 * @parameters({
	 *     @parameter("id", description="ID of Question", required=true, type="integer")
	 * })
	 */
	public function show( Question $question ) {
		return $question;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Question $question
	 *
	 * @return Question
	 *
	 * @put("/{id}")
	 * @patch("/{id}")
	 * @request({"text": "What?"})
	 * @response(200, body={"question":{"id":1,"text":"What?","challenge_id":1,"phase":1,"created_at":"2017-05-31 17:00:27","updated_at":"2017-05-31 17:18:28"}})
	 * @parameters({
	 *     @parameter("id", description="ID of Question", required=true, type="integer")
	 * })
	 */
	public function update( Request $request, Question $question ) {
		if ( ! $question->update( $request->all() ) ) {
			$this->response->errorInternal();
		}

		return $question;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Question $question
	 *
	 * @return \Illuminate\Http\Response
	 *
	 * @delete("/{id}")
	 * @response(204)
	 * @parameters({
	 *     @parameter("id", description="ID of Question", required=true, type="integer")
	 * })
	 */
	public function destroy( Question $question ) {
		if ( ! $question->delete() ) {
			$this->response->errorInternal();
		}

		return $this->response->noContent();
	}
}
