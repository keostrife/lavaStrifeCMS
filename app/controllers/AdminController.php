<?php

class AdminController extends Controller {

	public function landing() {
		if(Auth::check()) {
			$lang = App::getLocale();
			$contents = Content::where("language", $lang)->get()->toArray();
			$pages = array();
			foreach($contents as $content) {
				if(!in_array($content["page"], $pages))
					$pages[] = $content["page"];
			}
			$langs = DB::table('languages')->get();
			return View::make('admin.dashboard', array('pages' => $pages, 'contents' => $contents, 'langs' => $langs));
		} else {
			return View::make('admin.login');
		}
	}
	

	public function login() {
		return User::auth(array(
			"username" => Input::get("username"),
			"password" => Input::get("password"),
			"remember" => Input::get("remember"),
			"onError" => function($error){
				return View::make('admin.login',array("error" => $error));
			},
			"extraValidation" => function($user){
				if(!$user->active) {
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

	public function build() {
		if(Auth::check()) {
			$routeCollection = Route::getRoutes();
			foreach ($routeCollection as $value) {
				if(strpos($value->getPath(), "admin") !== 0) {
			    	file_get_contents('http' . (isset($_SERVER['HTTPS']) ? 's' : '')."://".$_SERVER["HTTP_HOST"].$value->getPath());
				}
			}
			return Redirect::to('admin');
		} else {
			return View::make('admin.login');
		}
	}

	public function update() {
		if(Auth::check()) {
			$uid = Input::get("uid");
			$page = Input::get("page");
			$lang = App::getLocale();
			$content = Input::get("content");

			Content::set($uid, $page, $lang, $content);
		} else {
			return View::make('admin.login');
		}
	}

	public function delete() {
		if(Auth::check()) {
			Content::remove(Input::get("uid"), Input::get("page"));
		} else {
			return View::make('admin.login');
		}
	}
}
