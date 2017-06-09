<?php

namespace App\Providers\Socialite\CustomSlack;

use SocialiteProviders\Slack\Provider as SlackProvider;
use GuzzleHttp\Exception\RequestException;

/**
 * Modifies socialiteproviders/slack to redirect to a custom team name
 * @package App\Providers\Socialite\CustomSlack
 */
class Provider extends SlackProvider {
	/**
	 * {@inheritdoc}
	 */
	protected function getAuthUrl($state)
	{
		return $this->buildAuthUrlFromBase(
			'https://' . env('SLACK_TEAM_NAME') . '.slack.com/oauth/authorize', $state
		);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getTokenUrl()
	{
		return 'https://' . env('SLACK_TEAM_NAME') . '.slack.com/api/oauth.access';
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getUserByToken($token)
	{
		try {
			$response = $this->getHttpClient()->get(
				'https://' . env('SLACK_TEAM_NAME') . '.slack.com/api/users.identity?token='.$token
			);
		} catch (RequestException $exception) {
			// Getting user informations requires the "identity.*" scopes, however we might want to not add them to the
			// scope list for various reasons. Instead of throwing an exception on this error, we return an empty user.

			if ($exception->hasResponse()) {
				$data = json_decode($exception->getResponse()->getBody(), true);

				if (array_get($data, 'error') === 'missing_scope') {
					return [];
				}
			}

			throw $exception;
		}

		return json_decode($response->getBody()->getContents(), true);
	}
}