<?php

namespace app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Socialite;

class LoginController extends Controller {
	public function adminRedirectToProvider() {
		return Socialite::driver( 'slack' )->redirectUrl(env('SLACK_ADMIN_REDIRECT_URI'))->redirect();
	}

	public function adminHandleProviderCallback() {
		$slackUser = Socialite::driver( 'slack' )->redirectUrl(env('SLACK_ADMIN_REDIRECT_URI'))->user();

		// Create user if doesn't exist
		if ( ! $user = User::where( 'slack_id', $slackUser->getId() )->first() ) {
			$user = User::create( [
				'name'      => $slackUser->getName(),
				'email'     => $slackUser->getEmail(),
				'thumbnail' => $slackUser->getAvatar(),
				'slack_id'  => $slackUser->getId()
			] );
		}

		Auth::login($user);

		return redirect( '/admin' );
	}
}