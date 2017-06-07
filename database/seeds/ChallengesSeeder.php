<?php

use Illuminate\Database\Seeder;

class ChallengesSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		foreach (App\Category::all() as $cat) {
			factory( App\Challenge::class, 2 )->create(['category_id' => $cat->id])
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
