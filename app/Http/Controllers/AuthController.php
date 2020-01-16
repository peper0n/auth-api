<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Validation\UserValidation;
use App\Services\AuthService;

class AuthController extends Controller {

	public function login(Request $request) {
		$rules = new UserValidation();
		$this->validate($request, $rules->loginRules());

		$regService = new AuthService();
		return $regService->login($request);



	}

	public function register(Request $request) {
		$rules = new UserValidation();

		$this->validate($request, $rules->registrationRules());

		$regService = new AuthService();
		$regService->registerNewUser($request);

		return response('You are registered successfully! Check your email for confirmation code!', 200);
	}

	public function confirmEmail(Request $request) {

		$rules = new UserValidation();
		$this->validate($request, $rules->confirmationRules());

		$regService = new AuthService();
		$confirmation = $regService->confirmEmail($request);

		return $confirmation;
	}

}
