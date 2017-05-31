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
	protected function createInsight( Request $request, Challenge $challenge ) {
		$data = $request->all();

		if ( ! isset( $data['phase'] ) ) {
			$data['phase'] = $challenge->phase;
		}

		if ( ! isset( $insight['challenge_id'] ) ) {
			$data['challenge_id'] = $challenge->id;
		}

		$insight = new Insight( $data );

		$challenge->insights()->save( $insight );

		return $insight;
	}

	/**
	 * Create multiple Insights at once
	 *
	 * @param Request $request
	 *
	 * @return bool
	 */
	protected function createInsights( Request $request ) {
		$insights = $request->get( 'insights' );

		// TODO: Make more efficient
		foreach ( $insights as $key => $insight ) {
			if ( ! isset( $insight['challenge_id'] ) ) {
				$insight['challenge_id'] = null;
				$insight['phase'] = null;
			}
			else {
				if ( ! isset( $insight['phase'] ) ) {
					$insight['phase'] = Challenge::findOrFail($insight['challenge_id'])->phase;
				}
			}

			$insights[$key] = $insight;
		}

		return Insight::insert( $insights );
	}
}