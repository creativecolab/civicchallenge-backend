<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Config;
use Cviebrock\DiscoursePHP\SSOHelper;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

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
	 * Checks if request needs SSO handling
	 *
	 * @param Request $request
	 * @param $user
	 *
	 * @return mixed
	 */
	protected function authenticated( Request $request, $user ) {
		// Handle SSO request if needed
		if ( $request->has( 'sso' ) && $request->has( 'sig' ) ) {
			return redirect( $this->processSSO( $request, $user ) );
		}

		return true;
	}

	/**
	 * Perform SSO functions for Discourse and return redirect URL
	 *
	 * @param Request $request
	 * @param $user
	 *
	 * @return string
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
			'name' => $user->name,
		];

		// Build query
		$query = $sso->getSignInString( $nonce, $userId, $userEmail, $extraParameters );
		$url   = Config::get( 'services.discourse.url' ) . '/session/sso_login?' . $query;

		return $url;
	}
}
