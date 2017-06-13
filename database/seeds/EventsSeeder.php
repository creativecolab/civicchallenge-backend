<?php

use Illuminate\Database\Seeder;

class EventsSeeder extends Seeder
{
	public function run()
	{
		factory(App\Event::class, 6)->create();
	}
}
