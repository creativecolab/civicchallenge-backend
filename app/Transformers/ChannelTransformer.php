<?php

namespace App\Transformers;

use App\Channel;
use League\Fractal\TransformerAbstract;

class ChannelTransformer extends TransformerAbstract
{
	/**
	 * List of resources possible to include
	 *
	 * @var array
	 */
	protected $availableIncludes = [
		'challenge',
		'questions',
	];

	/**
	 * Turn this item object into a generic array
	 *
	 * @param Channel $channel
	 *
	 * @return array
	 */
	public function transform( Channel $channel )
	{
		return [
			'id'          => (int) $channel->id,
			'name'        => $channel->name,
			'slackId'     => $channel->slack_id,
			'challengeId' => $channel->challenge_id,
			'condition'   => $channel->condition,
			'createdAt'   => $channel->created_at->timestamp,
			'updatedAt'   => $channel->updated_at->timestamp,
		];
	}

	public function includeChallenge( Channel $channel )
	{
		$challenge = $channel->challenge;

		return $this->item( $challenge, new ChallengeTransformer );
	}

	public function includeQuestions( Channel $channel )
	{
		return $this->collection( $channel->questions, new QuestionTransformer );
	}

}