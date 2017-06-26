<?php

namespace App\Transformers;

use App\Challenge;
use League\Fractal\ParamBag;
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

	public function includeResources( Challenge $challenge, ParamBag $params = null ) {
		$resources = $this->processAllPhases( $challenge, 'resources', $params );

		return $this->collection( $resources, new ResourceTransformer );
	}

	public function includeCategory( Challenge $challenge ) {
		return $this->item( $challenge->category, new CategoryTransformer );
	}

	public function includeQuestions( Challenge $challenge, ParamBag $params = null ) {
		$questions = $this->processAllPhases( $challenge, 'questions', $params );

		return $this->collection( $questions, new QuestionTransformer );
	}

	public function includeInsights( Challenge $challenge, ParamBag $params = null ) {
		$insights = $this->processAllPhases( $challenge, 'insights', $params );

		return $this->collection( $insights, new InsightTransformer );
	}

	/**
	 * Processes the allPhase parameter. Checks if it is set and returns resources from all phases if requested.
	 * Otherwise defaults to current phase only.
	 *
	 * @param Challenge $challenge
	 * @param $resourceKey
	 * @param ParamBag $params
	 *
	 * @return mixed
	 */
	protected function processAllPhases( Challenge $challenge, $resourceKey, ParamBag $params ) {
		$allPhases = (bool) $params->get( 'allPhases' );

		if ( ! $allPhases ) {
			$phase = $challenge->phase;
			$challenge->load( [
				$resourceKey => function ( $query ) use ( $phase ) {
					$query->where( 'phase', '=', $phase );
				}
			] );
		}

		return $challenge->$resourceKey;
	}

}