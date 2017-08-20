<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$accessToken = (isset($_GET['token'])) ? $_GET['token'] : 'No Access Token';

function getEndpoint($req_url) {
	global $accessToken;
        $ch = curl_init(); 
		echo $authURL = $req_url . '?' . $accessToken;
        curl_setopt($ch, CURLOPT_URL, $authURL); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);
    return json_decode($output);
}

$me = getEndpoint('https://api.instagram.com/v1/users/self');
echo sprintf('<li><img src="%s" alt="%s"><h3>Welcome %s</h3></li>', $me['profile_picture'], $me['username'], $me['full_name']);
print_r($me);
?>