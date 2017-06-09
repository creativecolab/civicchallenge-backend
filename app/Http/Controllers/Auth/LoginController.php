<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Config;
use Cviebrock\DiscoursePHP\SSOHelper;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Socialite;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Login
 * @package App\Http\Controllers\Auth
 * @resource("Authentication", uri="/login")
 */
class LoginController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	*/

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/home';

	/**
	 * Create a new controller instance.
	 */
	public function __construct() {
		$this->middleware( 'guest', [ 'except' => 'logout' ] );
	}

	/**
	 * Perform SSO functions for Discourse and return redirect URL
	 *
	 * @param Request $request
	 * @param $user
	 *
	 * @return string
	 *
	 * @deprecated
	 */
	protected function processSSO( Request $request, $user ) {
		// Set up SSO helper
		$sso = new SSOHelper();
		$sso->setSecret( Config::get( 'services.discourse.secret' ) );

		// Load payload
		$payload   = $request->input( 'sso' );
		$signature = $request->input( 'sig' );

		// Validate payload
		if ( ! ( $sso->validatePayload( $payload, $signature ) ) ) {
			throw new BadRequestHttpException( 'Bad SSO request!' );
		}

		// Get nonce
		$nonce = $sso->getNonce( $payload );

		// Create payload
		$userId          = $user->id;
		$userEmail       = $user->email;
		$extraParameters = [
			'name'               => $user->name,
			'require_activation' => true
		];

		// Build query
		$query = $sso->getSignInString( $nonce, $userId, $userEmail, $extraParameters );
		$url   = Config::get( 'services.discourse.url' ) . '/session/sso_login?' . $query;

		return $url;
	}

	/**
	 * Redirect to Slack login page
	 *
	 * @return mixed
	 *
	 * @get("/")
	 * @response(302)
	 */
	public function redirectToProvider() {
		return Socialite::driver( 'slack' )->stateless()->redirect();
	}

	/**
	 * Redirect to homepage with token
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 *
	 * @get("/callback/{?code,state}")
	 * @response(302)
	 */
	public function handleProviderCallback() {
		$slackUser = Socialite::driver( 'slack' )->stateless()->user();

		// Create user if doesn't exist
		if ( ! $user = User::where( 'slack_id', $slackUser->getId() )->first() ) {
			$user = User::create( [
				'name'      => $slackUser->getName(),
				'email'     => $slackUser->getEmail(),
				'thumbnail' => $slackUser->getAvatar(),
				'slack_id'  => $slackUser->getId()
			] );
		}

		$query = http_build_query( [
			'token'  => $slackUser->token,
			'uid'    => $user->id,
			'expiry' => $slackUser->expiresIn
		] );

		return redirect( '/?' . $query );
	}
}
