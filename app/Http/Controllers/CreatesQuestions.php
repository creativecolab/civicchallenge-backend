<?php

namespace App\Http\Controllers;

use App\Challenge;
use App\Question;
use Illuminate\Http\Request;

trait CreatesQuestions {
	/**
	 * Creates a Question object
	 *
	 * @param Request $request
	 * @param Challenge $challenge
	 *
	 * @return Question
	 * @internal param $challenge_id
	 *
	 */
	protected function createQuestion(Request $request, Challenge $challenge)
	{
		$data = $request->all();
		$data['phase'] = $challenge->phase;     // Take phase from Challenge
		$data['challenge_id'] = $challenge->id; // Take ID from Challenge

		$question = new Question($data);

		$challenge->questions()->save($question);

		return $question;
	}
}