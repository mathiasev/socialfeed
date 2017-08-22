/* Set Instagram cookie if code in url */
if(window.location.hash) {
  // Fragment exists
	var hash = window.location.hash;
	var token = hash.substring(1);
  
	var goURL = '../go.php?' + token;
	
	$.ajax({
		url: goURL,
		type: 'POST'
	})
	.done(function( data ) {
		window.location.hash = "";
		getPOSTS();
	});
}


getPosts();

function getPOSTS() {
	$.ajax({
	url: '../go.php?getPosts=true',
	  type: 'POST'
	})
	.done(function( data ) {
		$('#elasticstack').html(data);
	new ElastiStack( document.getElementById( 'elasticstack' ) );
	});
}