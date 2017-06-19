<?php

namespace App\Http\Controllers;

use App\Challenge;
use App\Insight;
use Illuminate\Http\Request;

trait CreatesInsights {
	/**
	 * Creates an Insight object
	 *
	 * @param Request $request
	 * @param Challenge $challenge
	 *
	 * @return false|\Illuminate\Database\Eloquent\Model
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

		if ( $request->has('ts') ) {
			$data['timestamp'] = $data['ts'];
		}

		$insight = new Insight( $data );

		return $challenge->insights()->save( $insight );
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
				$insight['phase']        = null;
			} else {
				if ( ! isset( $insight['phase'] ) ) {
					$insight['phase'] = Challenge::findOrFail( $insight['challenge_id'] )->phase;
				}
			}

			if ( isset( $insight['ts'] ) ) {
				$insight['timestamp'] = $insight['ts'];
			}

			$insights[ $key ] = $insight;
		}

		return Insight::insert( $insights );
	}
}