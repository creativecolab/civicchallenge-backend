<?php

use Illuminate\Database\Seeder;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	foreach (App\Challenge::all() as $challenge) {
		    factory(App\Question::class, 2)->create(['challenge_id' => $challenge->id, 'phase' => $challenge->phase]);
	    }
    }
}
