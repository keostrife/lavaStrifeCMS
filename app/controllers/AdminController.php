<?php

class AdminController extends Controller {

	public function landing(){
		if(Auth::check()){
			return View::make('admin.dashboard');
		} else {
			return View::make('admin.login');
		}
	}

	public function login(){
		return User::auth(array(
			"username" => Input::get("username"),
			"password" => Input::get("password"),
			"remember" => Input::get("remember"),
			"onError" => function($error){
				return View::make('admin.login',array("error" => $error));
			},
			"extraValidation" => function($user){
				if($user->locked) {
					$error = array();
					$error["locked"] = 1;
					return View::make('admin.login',array("error" => $error));
				} else {
					return true;
				}
			},
			"onSuccess" => function($user){
				return Redirect::to('/admin');
			}
		));
	}

	public function logout(){
		Auth::logout();
		return Redirect::to('/admin');
	}

	public function create(){
		if(!Input::get("username") || !Input::get("password") || !Input::get("email"))
			App::abort(404);
		else
			return User::createU(array(
				"username" => Input::get("username"),
				"password" => Input::get("password"),
				"email" => Input::get("email"),
				"onError" => function($error){
					if(isset($error["exist"]))
						echo "User already exist";
				},
				"onSuccess" => function($user){
					echo "User ".$user->username." has been created";
				}
			));
	}

}
