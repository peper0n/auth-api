<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use App\Models\User;

class ConfirmationTest extends TestCase {

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
	public function wrongConfirmation() {

		$user = User::create(
			[
				'email' => 'd@mail.ru',
				'password' => Hash::make('123123'),
				'confirmation_key' => Str::random(8),
			]);

		$response = $this->call('POST', '/auth/confirm/email', ['email' => 'd@mail.ru', 'confirmation_key' => '123123']);

		$this->assertEquals(422, $response->status());
	}

	/**
	 * @test
	 */
	public function correctConfirmation() {

		$user = User::create(
			[
				'email' => 'd@mail.ru',
				'password' => Hash::make('123123'),
				'confirmation_key' => Str::random(8),
			]);

		$response = $this->call('POST', '/auth/confirm/email', ['email' => 'd@mail.ru', 'confirmation_key' => $user->confirmation_key]);

		$this->assertEquals(200, $response->status());
	}
}
