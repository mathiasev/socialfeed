/* Set Instagram cookie if code in url */
if(window.location.hash) {
  // Fragment exists
  var hash = window.location.hash;
  
  document.cookie = "instagram" + hash.substring(1);
  
 	var instagramaccess_token = getCookie('instagram');

		console.log("Instagram Token: " + instagramaccess_token);
		
		var token = instagramaccess_token.substring(20);
		var goURL = 'go.php?instagram_token=' + token;
		
		$.ajax({
		  url: goURL,
		  type: 'POST'
		})
		.done(function( data ) {
window.location.replace('/home');

		});
}