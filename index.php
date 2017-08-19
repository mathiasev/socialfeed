<?php 

/* ---- Set up CURL ---- */
function getCURL($req_body, $req_url) {
			
	$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $req_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, '[' . $req_body . ']');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  

    print_r($ch);
    $jsonData = curl_exec($ch);
    curl_close($ch);
	$output = json_decode($jsonData);
    return $output;
}

if(isset($_GET['code'])) :
/* ---- Build Instagram oAuth Body ---- */
$instagramBody = array( 'client_id' => 'ddc788c63b2a444ca2898f6acaa88780',
						'client_secret' => '2caa337ca8484384913b300e684bfc0d',
						'grant_type' => 'authorization_code',
						'redirect_uri' => 'http://13.59.66.63/socialfeed/',
						'code' => $_GET['code']
						);

$instaBodyAPI = json_encode($instagramBody);

print_r($instaBodyAPI);
$instagramAuthorised = getCURL($instaBodyAPI, 'https://api.instagram.com/oauth/access_token');

print_r($instagramAuthorised);
endif;

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
				<li><a href="https://api.instagram.com/oauth/authorize/?client_id=ddc788c63b2a444ca2898f6acaa88780&redirect_uri=http://13.59.66.63/socialfeed/&response_type=code&scope=basic+public_content+follower_list+comments+relationships+likes" id="InstagramLogin">Log into Instagram</a></li>
			</ul>
		</div><!-- /container -->
		<script src="js/draggabilly.pkgd.min.js"></script>
		<script src="js/elastiStack.js"></script>
		<script>
			new ElastiStack( document.getElementById( 'elasticstack' ) );
		</script>
	</body>
</html>