<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<!--
<link rel="shortcut icon" href="/favicon.ico">
-->
<link rel="stylesheet" type="text/css" href="/assets/css/screen.css">
<!--[if IE]>
<link href="/assets/css/ie.css" media="screen, projection" rel="stylesheet" type="text/css" />
<![endif]-->
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<title>Admin Panel</title>
</head>
<body>
	
	@yield('content')

	<script type="text/javascript" src="/assets/js/main.min.js"></script>
	<!--
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	-->
	<script>
		$(document).ready(function(){
			//Stripe.setPublishableKey('[key]');
			App.init();
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