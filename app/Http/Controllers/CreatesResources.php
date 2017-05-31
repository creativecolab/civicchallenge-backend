<?php

namespace App\Http\Controllers;

use App\Challenge;
use App\Resource;
use Illuminate\Http\Request;

trait CreatesResources {
	/**
	 * Creates a Resource object
	 *
	 * @param Request $request
	 * @param Challenge $challenge
	 *
	 * @return \App\Resource
	 * @internal param $challenge_id
	 *
	 */
	protected function createResource(Request $request, Challenge $challenge)
	{
		$data = $request->all();
		$data['phase'] = $challenge->phase;     // Take phase from Challenge
		$data['challenge_id'] = $challenge->id; // Take ID from Challenge

		$resource = new Resource($data);

		$challenge->resources()->save($resource);

		return $resource;
	}
}