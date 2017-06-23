<?php

namespace App\Transformers;

use App\Insight;
use League\Fractal\TransformerAbstract;

class InsightTransformer extends TransformerAbstract {
	/**
	 * List of resources possible to include
	 *
	 * @var array
	 */
	protected $availableIncludes = [
		'user',
		'question',
		'challenge',
	];

	/**
	 * Turn this item object into a generic array
	 *
	 * @param Insight $insight
	 *
	 * @return array
	 */
	public function transform( Insight $insight ) {
		return [
			'id'           => (int) $insight->id,
			'text'         => $insight->text,
			'user_id'      => (int) $insight->user_id,
			'channel_id'   => $insight->channel_id,
			'timestamp'    => $insight->timestamp->timestamp,
			'thumbnail'    => $insight->thumbnail,
			'type'         => (int) $insight->type,
			'question_id'  => (int) $insight->question_id,
			'challenge_id' => (int) $insight->challenge_id,
			'phase'        => (int) $insight->phase,
			'slack_meta'   => (int) $insight->slack_meta,
			'createdAt'    => $insight->created_at->timestamp,
			'updatedAt'    => $insight->updated_at->timestamp,
		];
	}

	public function includeUser( Insight $insight ) {
		$this->item( $insight->user, new UserTransformer );
	}

	public function includeQuestion( Insight $insight ) {
		$this->item( $insight->question, new QuestionTransformer );
	}

	public function includeChallenge( Insight $insight ) {
		$this->item( $insight->challenge, new ChallengeTransformer );
	}
}
