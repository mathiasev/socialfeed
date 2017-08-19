if(window.location.hash) {
  // Fragment exists
  var hash = window.location.hash;
  var Instaurl = "https://api.instagram.com/v1/users/self/follows?" + hash.substring(1);
  
  $.ajax({
  url: Instaurl,
})
  .done(function( data ) {
    if ( console && console.log ) {
      console.log( "Sample of data:", data.slice( 0, 100 ) );
    }
  });
  
} else {
	$('#elasticstack').html('<li><a href="https://api.instagram.com/oauth/authorize/?client_id=ddc788c63b2a444ca2898f6acaa88780&redirect_uri=http://13.59.66.63/socialfeed/&response_type=token&scope=basic+public_content+follower_list+comments+relationships+likes" id="InstagramLogin">Log into Instagram</a></li>');

}