<?php

use Illuminate\Database\Seeder;

class ChallengesSeeder extends Seeder {
	const STAGING_DATA = [
		[
			'name'        => 'Accessibility',
			'category_id' => 1,
			'phase'       => App\Challenge::PHASE_START
		],
		[
			'name'        => 'Expanding Elder Rider Services',
			'category_id' => 2,
			'phase'       => App\Challenge::PHASE_START
		],
		[
			'name'        => 'Autonomous Vehicles',
			'category_id' => 3,
			'phase'       => App\Challenge::PHASE_START
		],
		[
			'name'        => 'Public Transit Feedback',
			'category_id' => 4,
			'phase'       => App\Challenge::PHASE_START
		],
		[
			'name'        => 'Smarter Parking',
			'category_id' => 5,
			'phase'       => App\Challenge::PHASE_START
		],
		[
			'name'        => 'Bicycling and Pedestrian Safety',
			'category_id' => 6,
			'phase'       => App\Challenge::PHASE_START
		],
		[
			'name'        => 'Making Traffic Tolerable',
			'category_id' => 7,
			'phase'       => App\Challenge::PHASE_START
		],
	];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		if ( App::environment( 'staging' ) ) {
			foreach ( static::STAGING_DATA as $challenge ) {
				factory( App\Challenge::class )->create( $challenge );
			}
		} else {
			foreach ( App\Category::all() as $cat ) {
				factory( App\Challenge::class, 2 )->create( [ 'category_id' => $cat->id ] )
				                                  ->each( function ( App\Challenge $c ) {
					                                  $c->resources()
					                                    ->save( factory( App\Resource::class )->make( [
						                                    'challenge_id' => $c->id,
						                                    'phase'        => $c->phase
					                                    ] ) );
				                                  } );
			}
		}
	}
}
