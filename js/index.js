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
        	var facebookaccess_token = getCookie('fbsr_879355528897757');

		console.log("Facebook Token: " + facebookaccess_token);
		
		var token = facebookaccess_token.substring(20);
		var goURL = 'go.php?facebook=' + token;
		
		$.ajax({
		  url: goURL,
		  type: 'POST'
		})
		.done(function( data ) {
window.location.replace('step2.php');

		});
      } else {
        alert('User cancelled login or did not fully authorize.');
      }
    });
    return false;
  };
  
  function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}