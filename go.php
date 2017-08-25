<?php require ('class.php');
   session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
echo '<!--'; print_r($_SESSION); echo '-->';

if (isset($_GET['access_token'])) 	: 	$stack = $_SESSION['STACK']; 
										$stack->setInstagramAccessToken($_GET['access_token']); 
										$_SESSION['STACK'] = $stack; 
										endif;
										
if (isset($_GET['facebook_token']))	:	$stack = $_SESSION['STACK']; 
										$stack->setFacebookAccessToken($_GET['facebook_token']); 
										$_SESSION['STACK'] = $stack; 
										endif;
										
if (isset($_GET['getPosts'])) 	  	:	$stack = $_SESSION['STACK']; 
										$stack->getProfile();
										$stack->getPosts();										
										$_SESSION['STACK'] = $stack;
										endif;
?>