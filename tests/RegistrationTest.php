<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Support\Str;

class RegistrationTest extends TestCase {

	use DatabaseTransactions;

	/**
	 * A basic test example.
	 *
	 * @return void
	 */

	public function setUp(): void {
		parent::setUp();

	}

	/**
	 * @test
	 */
	public function registrationNoPassword() {
		$response = $this->call('POST', '/auth/register', ['email' => 'd@mail.ru']);

		$this->assertEquals(422, $response->status());
	}

	/**
	 * @test
	 */
	public function registrationNoEmail() {
		$response = $this->call('POST', '/auth/register', ['email' => 'd@mail.ru']);

		$this->assertEquals(422, $response->status());
	}

	/**
	 * @test
	 */
	public function registration() {
		$response = $this->call('POST', '/auth/register', ['email' => Str::random(8) . '@mail.ru', 'password' => '123123', 'password_confirmation' => '123123']);

		$this->assertEquals(200, $response->status());
	}
}
