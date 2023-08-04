<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LocalizationContoller extends Controller{

	public function swithchLang($lang){

		if(array_key_exists($lang, Config::get('app.available_locales'))){
			Session::put('applocale',$lang);
		}

		return redirect()->back();
	}
}