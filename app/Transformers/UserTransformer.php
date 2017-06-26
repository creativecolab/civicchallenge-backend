<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;
use Storage;

class UserTransformer extends TransformerAbstract {

	protected $availableIncludes = [
		'insights'
	];

	/**
	 * Turn this item object into a generic array
	 *
	 * @param User $user
	 *
	 * @return array
	 */
	public function transform( User $user ) {
		return [
			'id'        => (int) $user->id,
			'slack_id'  => $user->slack_id,
			'name'      => $user->name,
			'email'     => $user->email,
			'thumbnail' => Storage::disk('public')->url($user->thumbnail),
		];
	}

	public function includeInsights( User $user ) {
		return $this->collection($user->insights, new InsightTransformer);
	}

}