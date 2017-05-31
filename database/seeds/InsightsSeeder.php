<?php

use Illuminate\Database\Seeder;

class InsightsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// TODO: Make more efficient
        foreach(App\User::all() as $user) {
        	foreach(App\Challenge::all() as $challenge) {
        		foreach($challenge->questions as $question ) {
			        factory(App\Insight::class)->create(
				        [
					        'user_id' => $user->id,
					        'question_id' => $question->id,
					        'challenge_id' => $challenge->id,
					        'phase' => $challenge->phase
				        ]
			        );
		        }
	        }
        }
    }
}
