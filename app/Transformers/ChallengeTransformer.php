<?php

namespace App\Transformers;

use App\Challenge;
use League\Fractal\TransformerAbstract;

class ChallengeTransformer extends TransformerAbstract {

	/**
	 * List of resources possible to include
	 *
	 * @var array
	 */
	protected $availableIncludes = [
		'questions',
	];

	/**
	 * Turn this item object into a generic array
	 *
	 * @param Challenge $challenge
	 *
	 * @return array
	 */
	public function transform( Challenge $challenge ) {
		return [
			'id'              => (int) $challenge->id,
			'summary'         => $challenge->summary,
			'description'     => $challenge->description,
			'longDescription' => $challenge->long_description,
			'thumbnail'       => $challenge->thumbnail,
			'phase'           => $challenge->phase,
			'createdAt'       => $challenge->created_at->timestamp,
			'updatedAt'       => $challenge->updated_at->timestamp,
		];
	}

	public function includeQuestions( Challenge $challenge ) {
		return $this->collection( $challenge->questions, new QuestionTransformer );
	}

}