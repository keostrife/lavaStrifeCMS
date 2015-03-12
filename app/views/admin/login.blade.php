@extends('admin.layout.main')

@section('content')
	<div id="wrapper">
		<section>
			<form action="/admin/login" method="post">
				<span class="error">{{{ isset($error["match"]) ? "Username or Password is not correct" : '' }}}</span><br>
				<span class="error">{{{ isset($error["locked"]) ? "Username has been locked" : '' }}}</span><br>
				<span class="error">{{{ isset($error["username"]) ? "Username is required!" : '' }}}</span><br>
				User: <input type="text" name="username" id="username" required> <br>
				<span class="error">{{{ isset($error["password"]) ? "Password is required!" : '' }}}</span><br>
				Pass: <input type="password" name="password" id="password" required> <br>
				Remember? <input type="checkbox" name="remember" id="remember" value="on"> <br>
				<input type="submit" id="loginSubmit">
			</form>
		</section>
	</div><!--Close Wrapper-->
@stop