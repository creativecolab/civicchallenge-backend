<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder {
	const STAGING_DATA = [
		[
			'name' => 'Accessibility',
		],
		[
			'name' => 'Elderly',
		],
		[
			'name' => 'Autonomous Vehicles',
		],
		[
			'name' => 'Public Transit',
		],
		[
			'name' => 'Parking',
		],
		[
			'name' => 'Urban Planning',
		],
		[
			'name' => 'Traffic',
		],
	];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		if ( App::environment( 'staging' ) ) {
			foreach ( static::STAGING_DATA as $category ) {
				factory( App\Category::class )->create( $category );
			}
		} else {
			factory( App\Category::class, 3 )->create();
		}
	}
}
