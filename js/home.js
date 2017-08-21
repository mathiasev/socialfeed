/* Set Instagram cookie if code in url */
if(window.location.hash) {
  // Fragment exists
  var hash = window.location.hash;
  var token = hash.substring(1);
  
var goURL = '../go.php?instagram' + token;
		console.log(goURL);
		$.ajax({
		  url: goURL,
		  type: 'POST'
		})
		.done(function( data ) {
			window.location.hash = "";
console.log("Ready");
		});
}

  function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}