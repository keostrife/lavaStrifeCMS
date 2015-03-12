<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<!--
<link rel="shortcut icon" href="/favicon.ico">
-->
<link rel="stylesheet" href="/assets/css/admin.css">
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<title>Admin Panel</title>
</head>
<body>
	
	@yield('content')

	<script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
	<script src="{{asset('assets/js/bootstrap.js')}}"></script>
	<script src="{{asset('assets/js/app.js')}}"></script>
	<script src="{{asset('assets/js/admin.js')}}"></script>
	<script>
		$(document).ready(function(){
			BR.init();
		});
	</script>
</body>
</html>

<!--
  __,               
 (    _/_    o  /)  
  `.  /  _  ,  // _ 
(___)(__/ (_(_//_(/_
             /)     
            (/      
-->