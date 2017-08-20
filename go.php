<?php 
$returnArr = array('GET' => print_r($_GET), 'POST' => print_r($_POST));

echo json_encode($returnArr);
?>