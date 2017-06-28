<?php

namespace App\Transformers;

use App\Question;
use League\Fractal\TransformerAbstract;

class QuestionTransformer extends TransformerAbstract {
	/**
	 * List of resources possible to include
	 *
	 * @var array
	 */
	protected $availableIncludes = [
		'challenge',
		'insights',
	];

	/**
	 * Turn this item object into a generic array
	 *
	 * @param Question $question
	 *
	 * @return array
	 */
	public function transform( Question $question ) {
		return [
			'id'           => (int) $question->id,
			'text'         => $question->text,
			'challengeId' => $question->challenge_id,
			'phase'        => (int) $question->phase,
			'createdAt'    => $question->created_at->timestamp,
			'updatedAt'    => $question->updated_at->timestamp,
		];
	}

	public function includeChallenge( Question $question ) {
		return $this->item( $question->challenge, new ChallengeTransformer );
	}

	public function includeInsights( Question $question ) {
		return $this->collection( $question->insights, new InsightTransformer );
	}

}
