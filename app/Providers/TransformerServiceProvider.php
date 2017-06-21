<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TransformerServiceProvider extends ServiceProvider {
	public function register() {
		app(\Dingo\Api\Transformer\Factory::class)->register('App\User', 'App\Transformers\UserTransformer');
	}
}