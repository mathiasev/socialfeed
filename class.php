<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* Overall Stack wrapper */
class Stack {
	private $instaAccessToken = 'No Token Set';
	private $facebookAccessToken = 'No Token Set';
	private $posts = array();
	
	/* Sets the Instagram token from user */
	function setInstagramAccessToken($_accessToken) {
		$this->instaAccessToken = 'access_token=' . $_accessToken;
	}
	
	/* Sets the Facebook token from user */
	function setFacebookAccessToken($_accessToken) {
		$this->facebookAccessToken = 'access_token=' . $_accessToken;
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
	
	/* Get Data from Facebook */
	private function getFacebookEndpoint($_req_url, $_req_param) {
		$authURL = 'https://graph.facebook.com/v2.10/' . $_req_url . '?' . htmlspecialchars($_req_param) . '&' . $this->facebookAccessToken;
		$ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $authURL); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);
		
		return json_decode($output);
	}
	
	private function getFacebookPosts() {
		
		$feed = $this->getFacebookEndpoint('me/feed', 'fields=attachments{title,type,url,description,media},message,type,created_time&limit=20');
		$feed = $feed->data;
		
		foreach ($feed as $post) :
			//print_r($post->attachments);
			$this->posts[] = new Post (
				'', 																										//Tite
				(isset($post->message))?$post->message: '', 																//Content
				(isset($post->attachments->data[0]->media->image->src))?$post->attachments->data[0]->media->image->src:'',	//Image
				$post->created_time,																						//Date
				'Me',																										//Author
				'facebook'																									//Format
			);
		endforeach;
	}
	
	/* Returns posts from friends */
	function getPosts() {
		
		$this->getInstagramPosts();
		$this->getFacebookPosts();
				
		foreach ($this->posts as $post) :
			echo '<li>';
			print_r($post);
			echo '</li>';
			echo sprintf('<li><div class="imageHolder" style="background-image: url(\'%s\');"></div><div class="caption"><div class="brand" style="background-color:%s;">%s</div><h2>%s</h2><p>%s</p><p><small>%s on %s</small></p></div></li>', $post->theImage(), $post->theBrandColour(), $post->theBrand(), $post->theTitle(), $post->theContent(), $post->theAuthor(), $post->thePostDate());
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
									$post->user->username,
									'instagram');
		endforeach;
	}
	
	/* Return Bio Details for front of Stack */
	function getProfile() {
		$me = $this->getInstagramEndpoint('https://api.instagram.com/v1/users/self');
		$me = $me->data;
		/* Ask for Facebook Access details */
		echo sprintf('<li><img src="%s" alt="%s"><h1>Welcome %s</h1></li>', $me->profile_picture, $me->username, $me->full_name);
	}
}

class Post {
	private $title, $content, $image, $postdate, $author, $brand;
	
	function __construct ($_title, $_content, $_image, $_date, $_author, $_brand) {
		$this->title 	= $_title;
		$this->content 	= $_content;
		$this->image	= $_image;
		$this->postdate	= $_date;
		$this->author	= $_author;
		$this->brand 	= $_brand;
	
	
	
	function theBrandColour() {
		switch ($this->brand):
			case 'facebook':
				return '#3b5998';
				break;
				
			case 'instagram':
				return '#833ab4';
				break;			
		endswitch;
	}
	
	function theBrand() {
		return ucfirst($this->brand);
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

?>