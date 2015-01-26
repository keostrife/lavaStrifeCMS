<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	/**
	 * Authenticate User (including Validation + Authentication)
	 *
	 * @string username/password
	 * @function onError($errors)/extraValidation($user)/onSuccess($user)
	 * return onError/onSuccess
	 */
	public static function auth($options) {
		$usertype = ''; //email or username
		$errors = array();

		//basic validation
		if(!isset($options["username"]) || !$options["username"]) {
			$errors["username"] = 1;
		}
		if(!isset($options["password"]) || !$options["password"]) {
			$errors["password"] = 1;
		}

		if(count($errors)>0) {
			if(isset($options["onError"]) && is_callable($options["onError"])) return $options["onError"]($errors);
		}

		$username = $options["username"];
		$password = $options["password"];
		//decide usertype
		if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
		    $usertype = "email";
		} else {
			$usertype = "username";
		}

		//check user existence
		$user = DB::select('select * from users where '.$usertype.' = ?', array($username));
		
		if(count($user) < 1 || !Hash::check($password, $user[0]->password)) {

			$errors["match"] = 1;
			if(isset($options["onError"]) && is_callable($options["onError"])) return $options["onError"]($errors);
		} else {
			$user = $user[0];

			//extra validation
			if(isset($options["extraValidation"]) && is_callable($options["extraValidation"])) {
				$result = $options["extraValidation"]($user);
				if($result != true) return $result;
			}

			//authentication
			$remember = $options["remember"]=="on";
			$user = User::find($user->id);
			$user->last_sign_in = new DateTime;
			$user->save();
			Auth::login($user, $remember);
			if(isset($options["onSuccess"]) && is_callable($options["onSuccess"])) return $options["onSuccess"]($user);

		    return Redirect::to('/admin');
		}
	}

	public static function createU($options) {
		$errors = array();
		$results = DB::select('select * from users where username = ? or email = ?', array($options["username"], $options["email"]));
		if(count($results) > 0) {
			$errors["exist"] = 1;
			if(isset($options["onError"]) && is_callable($options["onError"])) return $options["onError"]($errors);
		}

		DB::insert('insert into users (username, email, password) values (?, ?, ?)', array(
			$options["username"], 
			$options["email"],
			Hash::make($options["password"])
		));

		$users = DB::select('select * from users where username = ?', array($options["username"]));

		if(isset($options["onSuccess"]) && is_callable($options["onSuccess"])) return $options["onSuccess"]($users[0]);
	}

}
