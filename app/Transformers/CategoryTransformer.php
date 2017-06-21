<?php

namespace App\Transformers;

use App\Category;
use League\Fractal\TransformerAbstract;
use Storage;

class CategoryTransformer extends TransformerAbstract {

	/**
	 * Turn this item object into a generic array
	 *
	 * @param Category $category
	 *
	 * @return array
	 */
	public function transform( Category $category ) {
		return [
			'id'          => (int) $category->id,
			'name'        => $category->name,
			'description' => $category->email,
			'thumbnail'   => $category->thumbnail,
			'createdAt'   => $category->created_at->timestamp,
			'updatedAt'   => $category->updated_at->timestamp,
		];
	}

}