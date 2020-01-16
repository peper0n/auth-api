<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use App\Models\User;

class LoginTest extends TestCase {

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
	public function notConfirmedEmail() {

		$user = User::create(
			[
				'email' => 'd@mail.ru',
				'password' => Hash::make('123123'),
				'confirmation_key' => Str::random(8),
			]);

		$response = $this->call('POST', '/auth', ['email' => 'd@mail.ru', 'password' => '123123']);

		$this->assertEquals(422, $response->status());
	}

	/**
	 * @test
	 */
	public function wrongCredentials() {

		$user = User::create(
			[
				'email' => 'd@mail.ru',
				'password' => Hash::make('123123'),
				'confirmed' => '1',
			]);

		$response = $this->call('POST', '/auth', ['email' => 'd@mail.ru', 'password' => 'qweqwe']);

		$this->assertEquals(422, $response->status());
	}

	/**
	 * @test
	 */
	public function correctCredentials() {

		$user = User::create(
			[
				'email' => 'd@mail.ru',
				'password' => Hash::make('123123'),
				'confirmed' => '1',
			]);

		$response = $this->call('POST', '/auth', ['email' => 'd@mail.ru', 'password' => '123123']);

		$this->assertEquals(200, $response->status());
	}

}
