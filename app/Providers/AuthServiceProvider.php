<?php

namespace App\Providers;

use App\Services\AuthService;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider {

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}

	/**
	 * Boot the authentication services for the application.
	 *
	 * @return void
	 */
	public function boot() {
		$this->app->singleton('AuthService', function ($app) {
			return new AuthService();
		});
	}

	public function provides() {
		return ['AuthService'];
	}
}
