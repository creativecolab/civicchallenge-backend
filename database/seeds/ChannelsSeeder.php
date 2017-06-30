<?php

use Illuminate\Database\Seeder;

class ChannelsSeeder extends Seeder
{
	const STAGING_DATA = [
		[
			'name'         => 'advance-accessibility',
			'slack_id'     => 'G61STGG4W',
			'challenge_id' => 1,
			'condition'    => 0
		],

		[
			'name'         => 'imagine-accessibility',
			'slack_id'     => 'G60CNQND6',
			'challenge_id' => 1,
			'condition'    => 1
		],

		[
			'name'         => 'improve-accessibility',
			'slack_id'     => 'G61SUM1B8',
			'challenge_id' => 1,
			'condition'    => 2
		],

		[
			'name'         => 'promote-accessibility',
			'slack_id'     => 'G61SUM1B8',
			'challenge_id' => 1,
			'condition'    => 3
		],

		[
			'name'         => 'elder-commuters',
			'slack_id'     => 'G614FBS5A',
			'challenge_id' => 2,
			'condition'    => 0
		],

		[
			'name'         => 'senior-commuters',
			'slack_id'     => 'G60CTPP40',
			'challenge_id' => 2,
			'condition'    => 1
		],

		[
			'name'         => 'elder-riders',
			'slack_id'     => 'G614FHXEY',
			'challenge_id' => 2,
			'condition'    => 2
		],

		[
			'name'         => 'senior-riders',
			'slack_id'     => 'G614FNUCC',
			'challenge_id' => 2,
			'condition'    => 3
		],

		[
			'name'         => 'autonomous-issues',
			'slack_id'     => 'G60CV8HH6',
			'challenge_id' => 3,
			'condition'    => 0
		],

		[
			'name'         => 'autonomous-futures',
			'slack_id'     => 'G610WHSTV',
			'challenge_id' => 3,
			'condition'    => 1
		],

		[
			'name'         => 'autonomous-ideas',
			'slack_id'     => 'G6161688M',
			'challenge_id' => 3,
			'condition'    => 2
		],

		[
			'name'         => 'autonomous-views',
			'slack_id'     => 'G60G4P68Z',
			'challenge_id' => 3,
			'condition'    => 3
		],

		[
			'name'         => 'transit-comments',
			'slack_id'     => 'G6163C3A9',
			'challenge_id' => 4,
			'condition'    => 0
		],

		[
			'name'         => 'transit-feedback',
			'slack_id'     => 'G61TNN20P',
			'challenge_id' => 4,
			'condition'    => 1
		],

		[
			'name'         => 'transit-input',
			'slack_id'     => 'G60CZJ08G',
			'challenge_id' => 4,
			'condition'    => 2
		],

		[
			'name'         => 'transit-thoughts',
			'slack_id'     => 'G60G73F7T',
			'challenge_id' => 4,
			'condition'    => 3
		],

		[
			'name'         => 'smarter-parking',
			'slack_id'     => 'G60G7QYQH',
			'challenge_id' => 5,
			'condition'    => 0
		],

		[
			'name'         => 'better-parking',
			'slack_id'     => 'G6110CS75',
			'challenge_id' => 5,
			'condition'    => 1
		],

		[
			'name'         => 'genius-parking',
			'slack_id'     => 'G60D12L6L',
			'challenge_id' => 5,
			'condition'    => 2
		],

		[
			'name'         => 'clever-parking',
			'slack_id'     => 'G61652MUM',
			'challenge_id' => 5,
			'condition'    => 3
		],

		[
			'name'         => 'cycling-safety',
			'slack_id'     => 'G61T7H9HC',
			'challenge_id' => 6,
			'condition'    => 0
		],

		[
			'name'         => 'biking-safety',
			'slack_id'     => 'G6111RJ6P',
			'challenge_id' => 6,
			'condition'    => 1
		],

		[
			'name'         => 'cycler-safety',
			'slack_id'     => 'G6111TF3M',
			'challenge_id' => 6,
			'condition'    => 2
		],

		[
			'name'         => 'biker-safety',
			'slack_id'     => 'G61TRP2VD',
			'challenge_id' => 6,
			'condition'    => 3
		],

		[
			'name'         => 'tolerable-traffic',
			'slack_id'     => 'G616F3A85',
			'challenge_id' => 7,
			'condition'    => 0
		],

		[
			'name'         => 'bearable-traffic',
			'slack_id'     => 'G61U0K623',
			'challenge_id' => 7,
			'condition'    => 1
		],

		[
			'name'         => 'goodish-traffic',
			'slack_id'     => 'G60GJU13K',
			'challenge_id' => 7,
			'condition'    => 2
		],

		[
			'name'         => 'sufferable-traffic',
			'slack_id'     => 'G60GK233K',
			'challenge_id' => 7,
			'condition'    => 3
		],

	];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		if ( App::environment( 'staging' ) ) {
			foreach ( static::STAGING_DATA as $channel ) {
				factory( App\Channel::class )->create( $channel );
			}
		} else {
			foreach ( App\Challenge::all() as $challenge ) {
				factory( App\Channel::class, 2 )->create( [ 'challenge_id' => $challenge->id ] );
			}
		}
	}
}
