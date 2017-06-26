<?php

namespace App\Transformers;

use App\Challenge;
use League\Fractal\ParamBag;
use League\Fractal\TransformerAbstract;

class ChallengeTransformer extends TransformerAbstract {
	protected $params;

	/**
	 * List of resources possible to include
	 *
	 * @var array
	 */
	protected $availableIncludes = [
		'resources',
		'questions',
		'insights',
	];

	function __construct( $params = [] ) {
		$this->params = $params;
	}

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
		$resources = $this->processPhases( $challenge, 'resources', $params );

		return $this->collection( $resources, new ResourceTransformer );
	}

	public function includeCategory( Challenge $challenge ) {
		return $this->item( $challenge->category, new CategoryTransformer );
	}

	public function includeQuestions( Challenge $challenge, ParamBag $params = null ) {
		$questions = $this->processPhases( $challenge, 'questions', $params );

		return $this->collection( $questions, new QuestionTransformer );
	}

	public function includeInsights( Challenge $challenge, ParamBag $params = null ) {
		$insights = $this->processPhases( $challenge, 'insights', $params );

		return $this->collection( $insights, new InsightTransformer );
	}

	/**
	 * Processes phase parameters (allPhase, phase). Checks if it is set and returns resources from all phases OR specific phase if requested.
	 * Otherwise defaults to current phase only.
	 *
	 * @param Challenge $challenge
	 * @param $resourceKey
	 * @param ParamBag $params
	 *
	 * @return mixed
	 */
	protected function processPhases( Challenge $challenge, $resourceKey, ParamBag $params ) {
		$allPhases = ((bool) $params->get( 'allPhases' )) || $this->params['allPhases'];

		if ( ! $allPhases ) {
			// Default to current phase if specific phase is not requested
			if ( isset( $this->params['phase'] ) ) {
				$phase = $this->params['phase'];
			} else {
				$phase = $challenge->phase;
			}
			$challenge->load( [
				$resourceKey => function ( $query ) use ( $phase ) {
					$query->where( 'phase', '=', $phase );
				}
			] );
		}

		return $challenge->$resourceKey;
	}

}