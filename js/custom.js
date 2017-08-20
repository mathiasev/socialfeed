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



/* SIGN IN WITH INSTAGRAM  and GET DATA */
var cookies = document.cookie;
if( cookies) {
	console.log(cookies);
	var token = getCookie('instagramaccess_token');
	token = "access_token=" + token; 
	  var goURL = 'go.php?token=' + token;
  $.ajax({
	  url: goURL,
	  type: 'POST'
  })
  .done(function( data ) {
	  

   $('#elasticstack').html(data);
new ElastiStack( document.getElementById( 'elasticstack' ) );
  });
 
 
}
else if(window.location.hash) {
  // Fragment exists
  var hash = window.location.hash;
  
  document.cookie = "instagram" + hash.substring(1);
 
} else {
	$('#elasticstack').html('<li><a href="https://api.instagram.com/oauth/authorize/?client_id=ddc788c63b2a444ca2898f6acaa88780&redirect_uri=http://13.59.66.63/socialfeed/&response_type=token&scope=basic+public_content+follower_list+comments+relationships+likes" id="InstagramLogin">Log into Instagram</a></li>');

}


function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}