<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	echo "test";
});

Route::get('admin', function()
{
	if(Auth::check()){
		return View::make('admin.dashboard');
	} else {
		return View::make('admin.login');
	}
});

Route::post('admin', function()
{	
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
});

Route::get('admin/create', function()
{	
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
});

Route::get('admin/logout', function()
{
	Auth::logout();
	return Redirect::to('/admin');
});

