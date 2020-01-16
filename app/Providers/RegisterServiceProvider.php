<?php

namespace App\Providers;

use App\Services\AuthService;
use App\User;
use Illuminate\Support\ServiceProvider;

class RegisterServiceProvider extends ServiceProvider {

	public function register() {
		$this->app->singleton(AuthService::class, function ($app) {
			return new AuthService();
		});
	}

	public function provides() {
		return [AuthService::class];
	}
}
