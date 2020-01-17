<?php

namespace App\Services;

class ValidationService {

	public function registrationRules() {
		return [
			'email' => 'required|email|unique:users',
			'password' => 'required|confirmed',
		];
	}

	public function loginRules() {
		return [
			'email' => 'required|email|exists:users',
			'password' => 'required',
		];
	}

	public function confirmationRules() {
		return [
			'email' => 'exists:users',
		];
	}
}