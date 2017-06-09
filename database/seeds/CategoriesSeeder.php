<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
	const STAGING_DATA = [
		[
			'name' => 'Urban Planning',
		],
		[
			'name' => 'Crossing the Border',
		],
		[
			'name' => 'Parking',
		],
		[
			'name' => 'Ageing',
		],
		[
			'name' => 'Accessibility',
		],
		[
			'name' => 'Traffic',
		],
		[
			'name' => 'Autonomous Vehicles',
		],
	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	if (App::environment('staging')) {
    		foreach (static::STAGING_DATA as $category) {
    			factory(App\Category::class)->create($category);
		    }
	    }
	    else {
		    factory(App\Category::class, 3)->create();
	    }
    }
}
