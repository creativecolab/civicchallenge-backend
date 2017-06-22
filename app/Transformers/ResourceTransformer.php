<?php

namespace App\Transformers;

use App\Resource;
use League\Fractal\TransformerAbstract;

class ResourceTransformer extends TransformerAbstract {
	/**
	 * List of resources possible to include
	 *
	 * @var array
	 */
	protected $availableIncludes = [
		'challenge',
	];

	/**
	 * Turn this item object into a generic array
	 *
	 * @param Resource $resource
	 *
	 * @return array
	 */
	public function transform( Resource $resource ) {
		return [
			'id'           => (int) $resource->id,
			'name'         => $resource->name,
			'url'          => $resource->url,
			'description'  => $resource->description,
			'type'         => $resource->type,
			'challenge_id' => (int) $resource->challenge_id,
			'phase'        => (int) $resource->phase,
			'createdAt'    => $resource->created_at->timestamp,
			'updatedAt'    => $resource->updated_at->timestamp,
		];
	}

	public function includeChallenge( Resource $resource ) {
		return $this->item( $resource->challenge, new ChallengeTransformer );
	}

}
