<?php

use Illuminate\Database\Seeder;

class InsightsSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$userMin = App\User::min('id');
		$userMax = App\User::max('id');
		foreach ( App\Challenge::all() as $challenge ) {
			foreach ( $challenge->questions as $question ) {
				for ( $i = App\Insight::TYPE_MIN; $i <= App\Insight::TYPE_MAX; $i ++ ) {
					factory( App\Insight::class, 2 )->create(
						[
							'user_id'      => rand($userMin, $userMax),
							'question_id'  => $question->id,
							'challenge_id' => $challenge->id,
							'type'         => $i,
							'phase'        => $challenge->phase
						]
					);
				}
			}
		}
	}
}
