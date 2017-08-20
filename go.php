<?php 

$accessToken = (isset($_GET['token'])) ? $_GET['token'] : 'No Access Token';

function getEndpoint($req_url) {
        $ch = curl_init(); 
		echo $authURL = $req_url . '?' . $accessToken;
        curl_setopt($ch, CURLOPT_URL, $authURL); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);
    return json_decode($output);
}

$me = getEndpoint('https://api.instagram.com/v1/users/self');

print_r($me);
?>