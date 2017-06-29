<?php

namespace App\Transformers;

use App\Challenge;
use League\Fractal\ParamBag;
use League\Fractal\TransformerAbstract;

class ChallengeTransformer extends TransformerAbstract
{
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

	function __construct( $params = [] )
	{
		$this->params = $params;
	}

	/**
	 * Turn this item object into a generic array
	 *
	 * @param Challenge $challenge
	 *
	 * @return array
	 */
	public function transform( Challenge $challenge )
	{
		return [
			'id'              => (int) $challenge->id,
			'name'            => $challenge->name,
			'summary'         => $challenge->summary,
			'description'     => $challenge->description,
			'longDescription' => $challenge->long_description,
			'thumbnail'       => $challenge->thumbnail,
			'phase'           => $challenge->phase,
			'createdAt'       => $challenge->created_at->timestamp,
			'updatedAt'       => $challenge->updated_at->timestamp,
		];
	}

	public function includeResources( Challenge $challenge, ParamBag $params = null )
	{
		$resources = $this->processParams( $challenge, 'resources', $params );

		return $this->collection( $resources, new ResourceTransformer );
	}

	public function includeCategory( Challenge $challenge )
	{
		return $this->item( $challenge->category, new CategoryTransformer );
	}

	public function includeQuestions( Challenge $challenge, ParamBag $params = null )
	{
		$questions = $this->processParams( $challenge, 'questions', $params );

		return $this->collection( $questions, new QuestionTransformer );
	}

	public function includeInsights( Challenge $challenge, ParamBag $params = null )
	{
		$insights = $this->processParams( $challenge, 'insights', $params );

		return $this->collection( $insights, new InsightTransformer );
	}

	/**
	 * Processes parameters (allPhase, phase, insightTypes). Checks if it is set and returns resources from all phases OR specific phase if requested.
	 * Otherwise defaults to current phase only.
	 *
	 * @param Challenge $challenge
	 * @param $resourceKey
	 * @param ParamBag $params
	 *
	 * @return mixed
	 */
	protected function processParams( Challenge $challenge, $resourceKey, ParamBag $params )
	{
		if ( isset( $this->params['allPhases'] ) ) {
			$allPhases = $this->params['allPhases'];
		} else {
			$allPhases = (bool) $params->get( 'allPhases' );
		}
		$insightTypes = $params->get( 'types' );

		// Set default insight types
		if ( $resourceKey === 'insights' && empty( $insightTypes ) ) {
			$insightTypes = [ 1, 2 ];
		}

		if ( ! $allPhases ) {
			// Default to current phase if specific phase is not requested
			if ( isset( $this->params['phase'] ) ) {
				$phase = $this->params['phase'];
			} else {
				$phase = $challenge->phase;
			}

			// Define phase function for later use
			$phaseFunction = function ( $query ) use ( $phase ) {
				$query->where( 'phase', '=', $phase );
			};

			// Query for insights only (better performance if we do a query all at once)
			if ( $resourceKey === 'insights' && ! empty( $insightTypes ) ) {
				$challenge->load( [
					$resourceKey => function ( $query ) use ( $phase, $phaseFunction, $insightTypes ) {
						$query->whereIn( 'type', $insightTypes );

						return $phaseFunction( $query );
					}
				] );
			} else {
				$challenge->load( [
					$resourceKey => $phaseFunction
				] );
			}
		} else {
			if ( $resourceKey === 'insights' && ! empty( $insightTypes ) ) {
				$challenge->load( [
					$resourceKey => function ( $query ) use ( $insightTypes ) {
						$query->whereIn( 'type', $insightTypes );
					}
				] );
			}
		}

		return $challenge->$resourceKey;
	}

}