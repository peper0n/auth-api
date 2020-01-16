<?php

namespace App\Http\Controllers;

use App\Http\Validation\UserValidation;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller {

	public function index() {
		return (User::all(['name', 'email', 'confirmed']));
	}

	public function show($id) {
		return (User::findOrFail($id, ['name', 'email', 'confirmed']));
	}

	public function store(Request $request) {
		//store user data
	}


}
