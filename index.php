<?php  ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); require('class.php'); session_start(); $stack = new Stack(); $_SESSION['STACK'] = $stack; ?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Stack</title>
		<meta name="description" content="Stack - The Easy Social Aggregator" />
		<meta name="author" content="Mathias Everson" />
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<script src="js/modernizr.custom.js"></script>
	</head>
	<body>
		<div class="container">
			<!-- Top Navigation -->
			<ul id="elasticstack" class="elasticstack">
				<li style="background-color: #3b5998; color: #ffffff; display: table;"><p style="display: table-cell; text-align: center; vertical-align: middle;"><a style="color: #fff; font-weight: 700; text-decoration: none; font-size: 1.2em;" href="#" onClick="logInWithFacebook()">Log In to Facebook</a></p></li>
				
			</ul>
		</div><!-- /container -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="js/draggabilly.pkgd.min.js"></script>
		<script src="js/elastiStack.js"></script>
		<script src="js/index.js"></script>
		<script>
			new ElastiStack( document.getElementById( 'elasticstack' ) );
		</script>
	</body>
</html>