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
		'resources',
		'category',
		'questions',
		'insights',
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

	public function includeResources( Challenge $challenge ) {
		return $this->collection( $challenge->resources, new ResourceTransformer );
	}

	public function includeCategory( Challenge $challenge ) {
		return $this->item( $challenge->category, new CategoryTransformer );
	}

	public function includeQuestions( Challenge $challenge ) {
		return $this->collection( $challenge->questions, new QuestionTransformer );
	}

	public function includeInsights( Challenge $challenge ) {
		return $this->collection( $challenge->insights, new InsightTransformer );
	}

}