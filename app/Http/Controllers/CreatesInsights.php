<?php

namespace App\Http\Controllers;

use App\Challenge;
use App\Insight;
use App\User;
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

		if ( $request->has( 'ts' ) ) {
			$data['timestamp'] = $data['ts'];
		}

		// Convert Slack ID to user ID
		if ( $request->has( 'slack_id' ) ) {
			$data['user_id'] = User::where( 'slack_id', $data['slack_id'] )->first()->id;
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

			// Convert Slack ID to user ID
			if ( isset( $insight['slack_id'] ) ) {
				$insight['user_id'] = User::findWhere( 'slack_id', $insight['slack_id'] );
			}

			$insights[ $key ] = $insight;
		}

		return Insight::insert( $insights );
	}
}