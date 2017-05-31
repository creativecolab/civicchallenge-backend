<?php

use Illuminate\Database\Seeder;

class ChallengesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Challenge::class, 20)->create()->each(function (App\Challenge $c) {
        	$c->resources()
	          ->save(factory(App\Resource::class)->make(['challenge_id' => $c->id, 'phase' => $c->phase]));
        });
    }
}
