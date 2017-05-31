<?php

namespace App\Providers\Socialite\CustomSlack;

use SocialiteProviders\Manager\SocialiteWasCalled;

/**
 * Modifies socialiteproviders/slack to redirect to a custom team name
 * @package App\Providers\Socialite\CustomSlack
 */
class CustomSlackExtendSocialite {
	/**
	 * Register the provider.
	 *
	 * @param \SocialiteProviders\Manager\SocialiteWasCalled $socialiteWasCalled
	 */
	public function handle(SocialiteWasCalled $socialiteWasCalled)
	{
		$socialiteWasCalled->extendSocialite(
			'slack', __NAMESPACE__.'\Provider'
		);
	}
}
