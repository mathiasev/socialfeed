/* FACEBOOK LOGIN */
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '879355528897757',
      autoLogAppEvents : true,
      xfbml            : true,
	  cookie		   : true,
      version          : 'v2.10'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

   
    logInWithFacebook = function() {
    FB.login(function(response) {
      if (response.authResponse) {
        alert('You are logged in &amp; cookie set!');
        // Now you can redirect the user or do an AJAX request to
        // a PHP script that grabs the signed request from the cookie.
      } else {
        alert('User cancelled login or did not fully authorize.');
      }
    });
    return false;
  };

/* Set Instagram cookie if code in url */
if(window.location.hash) {
  // Fragment exists
  var hash = window.location.hash;
  
  document.cookie = "instagram" + hash.substring(1);
  
 
} 
 
var cookies = document.cookie;
	var instagramaccess_token = getCookie('instagramaccess_token');
	var facebookaccess_token = getCookie('fbsr_879355528897757');

if(instagramaccess_token == 'undefined') { 
	
	// Get Instagram sign in
		$('#elasticstack').html('<li><p><a href="https://api.instagram.com/oauth/authorize/?client_id=ddc788c63b2a444ca2898f6acaa88780&redirect_uri=http://13.59.66.63/socialfeed/&response_type=token&scope=basic+public_content+follower_list+comments+relationships+likes" id="InstagramLogin">Log into Instagram</a></p></li>');

} else {
	
	
	if (facebookaccess_token != 'undefined' && instagramaccess_token != 'undefined') {
		console.log("Facebook Token: " + facebookaccess_token);
		console.log("Instagram Token: " + instagramaccess_token);
		
		// Get Posts
		var token = "instagram_token=" + instagramaccess_token; 
			token += "facebook_token=" + facebookaccess_token;
		var goURL = 'go.php?' + token;
		
		$.ajax({
		  url: goURL,
		  type: 'POST'
		})
		.done(function( data ) {
			$('#elasticstack').html(data);
			new ElastiStack( document.getElementById( 'elasticstack' ) );
		});

	}
	else if (facebookaccess_token == 'undefined') {
		// Sign in with Facebook 
		$('#elasticstack').html('<li><p><a href="#" onClick="logInWithFacebook()">Log In to Facebook</a></p></li>');

	}}
	
	

function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}