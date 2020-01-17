<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \AuthService;
use \ValidationService;

class AuthController extends Controller {

	public function login(Request $request) {

		$this->validate($request, ValidationService::loginRules());

		return AuthService::login($request);
	}

	public function register(Request $request) {

		$this->validate($request, ValidationService::registrationRules());

		AuthService::registerNewUser($request);

		return response('You are registered successfully! Check your email for confirmation code!', 200);
	}

	public function confirmEmail(Request $request) {

		$this->validate($request, ValidationService::confirmationRules());

		return AuthService::confirmEmail($request);
	}

}
