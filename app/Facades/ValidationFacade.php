<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ValidationFacade extends Facade {

	protected static function getFacadeAccessor() {

		return 'ValidationService';
	}

}