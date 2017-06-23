<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TransformerServiceProvider extends ServiceProvider {
	public function register() {
		$transformers = [
			'App\Category'  => 'App\Transformers\CategoryTransformer',
			'App\Challenge' => 'App\Transformers\ChallengeTransformer',
			'App\Event'     => 'App\Transformers\EventTransformer',
			'App\Insight'   => 'App\Transformers\InsightTransformer',
			'App\Question'  => 'App\Transformers\QuestionTransformer',
			'App\Resource'  => 'App\Transformers\ResourceTransformer',
			'App\User'      => 'App\Transformers\UserTransformer',
		];

		foreach ( $transformers as $class => $transformer ) {
			app( \Dingo\Api\Transformer\Factory::class )->register( $class, $transformer );
		}
	}
}