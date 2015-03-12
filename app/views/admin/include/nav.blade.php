<nav class="navbar navbar-default">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#"><img alt="babyrobot" width="40" height="24" src="{{asset('assets/images/br_white.png')}}"></a>
			<p class="navbar-text">Hello {{ Auth::user()->username }}</p>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="{{url('admin/build')}}">Dev Build</a></li>
				<li><a href="">Users</a></li>
				<li><a href="">Languages</a></li>
				<li><a href="{{url('admin/logout')}}">Log out</a></li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>