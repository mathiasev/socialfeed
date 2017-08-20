<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* Overall Stack wrapper */
class Stack {
	private $instaAccessToken = 'No Token Set';
	private $posts = array();
	
	/* Sets the Instagram token from user */
	function setInstagramAccessToken($_accessToken) {
		$this->instaAccessToken = $_accessToken;
	}
	
	/* Get Data from Instagram */
	private function getInstagramEndpoint($_req_url) {
		$authURL = $_req_url . '?' . $this->instaAccessToken;
        
		$ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $authURL); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);
		
		return json_decode($output);
	}
	
	/* Returns posts from friends */
	function getPosts() {
		
		$this->getInstagramPosts();
				
		foreach ($this->posts as $post) :
			echo sprintf('<li><div class="imageHolder" style="background-image: url(\'%s\');"></div><div class="caption"><h2>%s</h2><p>%s</p></div></li>', $post->theImage(), $post->theTitle(), $post->theContent());
		endforeach;
	}
	
	private function getInstagramPosts() {
		/**	INSTAGRAM 
			1. Get array of Friends
			2. Get latest posts for each friends
			3. Order by Date
		**/
		
		$following = $this->getInstagramEndpoint('https://api.instagram.com/v1/users/self/follows');
		$following = $following->data;
		
		foreach ($following as $user) :
			$this->getInstagramUserPosts($user->id);
		endforeach;
	}
	
	private function getInstagramUserPosts($_userID) {
		$posts = $this->getInstagramEndpoint('https://api.instagram.com/v1/users/' . $_userID . '/media/recent');
		$posts = $posts->data;
		
		foreach ($posts as $post):
		
			$this->posts[] = new Post('',
									(isset($post->caption->text)) ? $post->caption->text : '',
									$post->images->standard_resolution->url,
									$post->created_time, 
									$post->user->username);
		endforeach;
	}
	
	/* Return Bio Details for front of Stack */
	function getProfile() {
		$me = $this->getInstagramEndpoint('https://api.instagram.com/v1/users/self');
		$me = $me->data;
		echo sprintf('<li><img src="%s" alt="%s"><h1>Welcome %s</h1></li>', $me->profile_picture, $me->username, $me->full_name);
	}
}

class Post {
	private $title, $content, $image, $postdate, $author;
	
	function __construct ($_title, $_content, $_image, $_date, $_author) {
		$this->title 	= $_title;
		$this->content 	= $_content;
		$this->image	= $_image;
		$this->postdate	= $_date;
		$this->author	= $_author;
	}
	
	function theTitle() {
		return $this->title;
	}
	
	function theContent() {
		return $this->content;
	}
	
	function theImage() {
		return $this->image;
	}
	
	function thePostDate() {
		return $this->postdate;
	}
	
	function theAuthor() {
		return $this->author;
	}
}

$stack = new Stack();
$stack->setInstagramAccessToken((isset($_GET['token'])) ? $_GET['token'] : 'No Access Token');
$stack->getProfile();
$stack->getPosts();

?>