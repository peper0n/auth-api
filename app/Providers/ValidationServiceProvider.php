<?php

namespace App\Providers;

use App\Services\ValidationService;
use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider {

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
		$this->app->singleton('ValidationService', function ($app) {
			return new ValidationService();
		});
	}

	public function provides() {
		return ['ValidationService'];
	}
}
