<?php

use Illuminate\Database\Seeder;

class ChannelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	foreach (App\Challenge::all() as $challenge) {
		    factory(App\Channel::class, 2)->create(['challenge_id' => $challenge->id]);
	    }
    }
}
