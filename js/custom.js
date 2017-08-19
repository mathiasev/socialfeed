if(window.location.hash) {
  // Fragment exists
  var hash = window.location.hash;
  var Instaurl = "https://api.instagram.com/v1/users/self/follows?" + hash.substring(1);
  
  $.ajax({
  url: Instaurl,
  dataType: 'jsonp',
	type: 'GET',
})
  .done(function( data ) {
	  
	  for (var key in data) {
    // skip loop if the property is from prototype
    if (!validation_messages.hasOwnProperty(key)) continue;

    var obj = validation_messages[key];
    for (var prop in obj) {
        // skip loop if the property is from prototype
        if(!obj.hasOwnProperty(prop)) continue;

        // your code
        alert(prop + " = " + obj[prop]);
    }
}
   $('#elasticstack').html('<li>' + data.data + '</li>');
  });
  
} else {
	$('#elasticstack').html('<li><a href="https://api.instagram.com/oauth/authorize/?client_id=ddc788c63b2a444ca2898f6acaa88780&redirect_uri=http://13.59.66.63/socialfeed/&response_type=token&scope=basic+public_content+follower_list+comments+relationships+likes" id="InstagramLogin">Log into Instagram</a></li>');

}