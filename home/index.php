<?php ?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Stack</title>
		<meta name="description" content="Stack - The Easy Social Aggregator" />
		<meta name="author" content="Mathias Everson" />
		<link rel="stylesheet" type="text/css" href="../css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="../css/demo.css" />
		<link rel="stylesheet" type="text/css" href="../css/component.css" />
		<script src="../js/modernizr.custom.js"></script>
	</head>
	<body>
		<div class="container">
			<!-- Top Navigation -->
			<ul id="elasticstack" class="elasticstack">
				<li>Let's Start</li>
				
			</ul>
		</div><!-- /container -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="../js/draggabilly.pkgd.min.js"></script>
		<script src="../js/elastiStack.js"></script>
		<script src="../js/home.js"></script>
		<script>
			new ElastiStack( document.getElementById( 'elasticstack' ) );
		</script>
	</body>
</html>