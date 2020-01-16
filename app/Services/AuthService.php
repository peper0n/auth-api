<?php

namespace App\Services;

use App\Jobs\SendConfirmation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\VarDumper\Cloner\Data;

class AuthService {

	public function login($request) {

		$user = User::where('email', $request->email)->first();

		if(!$user->confirmed) {
			return response('Confirm your email first!', 422);
		}

		if(Hash::check($request->password, $user->password)) {

			if(Carbon::now()->greaterThan($user->token_expire)) {
				$user->token = Str::random(32);
				$user->token_expire = (Carbon::now()->addDay());
				$user->update();
				return response($user->token, 200);
			}
			else {

				return response($user->token, 200);
			}
		}
		return response('Wrong credentials!', 422);
	}

	public function registerNewUser($request) {

		$user = User::create(
			[
				'email' => $request->email,
				'password' => Hash::make($request->password),
				'confirmation_key' => Str::random(8),
				'token_expire' => Carbon::now()
			]
		);

		Dispatch(new SendConfirmation(['email' => $request->email, 'code' => $user->confirmation_key]));

		return $user;
	}

	public function confirmEmail($request) {


		$user = User::where('email', $request->email)->first();

		if($user->confirmed == 1) {
			return response('Email Already confirmed, please log in!', 422);
		}
		else {
			if($user->confirmation_key == $request->confirmation_key) {
				$user->update(['confirmed' => 1]);
				return response('Email confirmed, please log in to get token!', 200);
			}
			else {
				return response('Wrong confirmation key!', 422);
			}
		}
	}
}