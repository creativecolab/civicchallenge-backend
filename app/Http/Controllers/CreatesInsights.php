<?php

namespace App\Http\Controllers;

use App\Challenge;
use App\Insight;
use Illuminate\Http\Request;

trait CreatesInsights {
	/**
	 * Creates am Insight object
	 *
	 * @param Request $request
	 * @param Challenge $challenge
	 *
	 * @return Insight
	 * @internal param $challenge_id
	 *
	 */
	protected function createInsight(Request $request, Challenge $challenge)
	{
		$data = $request->all();
		$data['phase'] = $challenge->phase;     // Take phase from Challenge
		$data['challenge_id'] = $challenge->id; // Take ID from Challenge

		$insight = new Insight($data);

		$challenge->insights()->save($insight);

		return $insight;
	}
}