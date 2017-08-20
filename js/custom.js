if(window.location.hash) {
  // Fragment exists
  var hash = window.location.hash;
  var goURL = 'go.php?token=' + hash.substring(1);
  $.ajax({
	  url: goURL,
	  type: 'POST'
  })
  .done(function( data ) {
	  

   $('#elasticstack').html(data);
new ElastiStack( document.getElementById( 'elasticstack' ) );
  });
  
} else {
	$('#elasticstack').html('<li><a href="https://api.instagram.com/oauth/authorize/?client_id=ddc788c63b2a444ca2898f6acaa88780&redirect_uri=http://13.59.66.63/socialfeed/&response_type=token&scope=basic+public_content+follower_list+comments+relationships+likes" id="InstagramLogin">Log into Instagram</a></li>');

}