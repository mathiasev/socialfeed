<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$stack = new Stack();

$stack->setAccessToken((isset($_GET['token'])) ? $_GET['token'] : 'No Access Token');

class Stack {
	private $instaAccessToken = 'No Token Set';
	
	function setAccessToken($accessToken) {
		$this->instaAccessToken = $accessToken;
	}
	
	private function getEndpoint($req_url) {
		$authURL = $req_url . '?' . $this->instaAccessToken;
        
		$ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $authURL); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);
		
		return json_decode($output);
	}
	
	function getProfile() {
		$me = $this->getEndpoint('https://api.instagram.com/v1/users/self');
		$me = $me->data;
		echo sprintf('<li><img src="%s" alt="%s"><h3>Welcome %s</h3></li>', $me->profile_picture, $me->username, $me->full_name);
	}
}

$stack->getProfile();


?>