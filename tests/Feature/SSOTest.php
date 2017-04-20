<?php

namespace Tests\Feature;

use App\User;
use Config;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SSOTest extends TestCase {

	use DatabaseMigrations;

	protected $sso = "bm9uY2U9Y2I2ODI1MWVlZmI1MjExZTU4YzAwZmYxMzk1ZjBjMGI=";
	protected $sig = "78f55d2f0cd8a3b65ad128d2b486bf59a570e0029d42370463d63523f25e37bf";
	protected $user;

	public function setUp() {
		parent::setUp();
		$this->user = User::create( [
			'name'           => 'Test',
			'email'          => 'test@example.com',
			'password'       => bcrypt( 'secret' ),
			'remember_token' => str_random( 10 ),
		] );
	}

	/**
	 * Test SSO login
	 */
	public function testSSOLogin() {
		$response = $this->post( '/login',
			[
				'email'    => $this->user->email,
				'password' => 'secret',
				'sso'      => urlencode( $this->sso ),
				'sig'      => $this->sig
			]
		);

		$response->assertStatus( 302 );
		$response->assertSee( Config::get( 'services.discourse.url' ) ); // Check to see if the redirect is to our URL
	}

	/**
	 * Test if request will fail upon bad SSO request
	 */
	public function testSSOLoginFailure() {
		$response = $this->post( '/login',
			[
				'email'    => $this->user->email,
				'password' => 'secret',
				'sso'      => urlencode( $this->sso ),
				'sig'      => '1234' // Bogus signature
			]
		);

		$response->assertStatus( 400 );
	}

	/**
	 * Test if the redirect link is correct
	 */
	public function testSSORedirect() {
		$query = "sso=bm9uY2U9Y2I2ODI1MWVlZmI1MjExZTU4YzAwZmYxMzk1ZjBjMGImZXh0ZXJuYWxfaWQ9MSZlbWFpbD10ZXN0JTQwZXhhbXBsZS5jb20mbmFtZT1UZXN0JnJlcXVpcmVfYWN0aXZhdGlvbj0x&sig=1133ff685003085cfb13e781c88724b00e81cf56ef9a63f41ddfe29af7defc3b";

		$response = $this->post( '/login',
			[
				'email'    => $this->user->email,
				'password' => 'secret',
				'sso'      => urlencode( $this->sso ),
				'sig'      => $this->sig
			]
		);

		$expected = Config::get( 'services.discourse.url' ) . '/session/sso_login?' . $query;

		$response->assertRedirect( $expected );
	}
}
