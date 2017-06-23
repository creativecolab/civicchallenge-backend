<?php

namespace App\Transformers;

use App\Event;
use League\Fractal\TransformerAbstract;

class EventTransformer extends TransformerAbstract {
	/**
	 * Turn this item object into a generic array
	 *
	 * @param Event $event
	 *
	 * @return array
	 */
	public function transform( Event $event ) {
		return [
			'id'          => (int) $event->id,
			'name'        => $event->name,
			'date'        => $event->date->timestamp,
			'description' => $event->description,
			'url'         => $event->url,
			'createdAt'   => $event->created_at->timestamp,
			'updatedAt'   => $event->updated_at->timestamp,
		];
	}

}
