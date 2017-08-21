<?php require 'class.php';
 $stack = $_SESSION['STACK'];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_GET['access_token'])) : $stack->setInstagramAccessToken($_GET['access_token']); endif;
if (isset($_GET['getPosts'])) 	  :	$stack->getProfile();
									$stack->getPosts();										endif;
									


$_SESSION['STACK'] = $stack;
?>