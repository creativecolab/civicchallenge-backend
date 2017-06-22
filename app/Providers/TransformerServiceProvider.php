<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TransformerServiceProvider extends ServiceProvider {
	public function register() {
		$transformers = [
			'App\Category'  => 'App\Transformers\CategoryTransformer',
			'App\Challenge' => 'App\Transformers\ChallengeTransformer',
			'App\User'      => 'App\Transformers\UserTransformer',
		];

		foreach ( $transformers as $class => $transformer ) {
			app( \Dingo\Api\Transformer\Factory::class )->register( $class, $transformer );
		}
	}
}