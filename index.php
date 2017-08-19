<?php 
$stack = new Stack();

class Stack {
	private $instagramAccessToken = 'UNAUTHOURISED';
	private $alive = false;

	function isAlive() {
		return $this->alive;
	}
	
	function setAuthCode($authCode) {
		$this->instagramAccessToken = $authCode;
	}
	
	
	function getPosts() {
		
		$friends = getFriends();
		
	}
	
	private function getFriends() {
	$friends = getEndpoint('https://api.instagram.com/v1/users/self/follows');
	print_r($friends);
}

/* ---- Set up CURL ---- */
private function getEndpoint($req_url) {
	$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $req_url . '?access_token=' . $this->instagramAccessToken);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
    $jsonData = curl_exec($ch);
    curl_close($ch);
	$output = json_decode($jsonData);
    return $output;
}

}






?><!DOCTYPE html>
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
				<?php
					if( isset($_GET['access_token']) ): 
						$stack->setAuthCode($_GET['access_token']); 
					else:
						echo '<li><a href="https://api.instagram.com/oauth/authorize/?client_id=ddc788c63b2a444ca2898f6acaa88780&redirect_uri=http://13.59.66.63/socialfeed/&response_type=token&scope=basic+public_content+follower_list+comments+relationships+likes" id="InstagramLogin">Log into Instagram</a></li>'; 
					endif; 
					
					if($stack->isAlive()): $stack->getPosts(); endif; 
				?>
			</ul>
		</div><!-- /container -->
		<script src="js/draggabilly.pkgd.min.js"></script>
		<script src="js/elastiStack.js"></script>
		<script>
			new ElastiStack( document.getElementById( 'elasticstack' ) );
		</script>
	</body>
</html>