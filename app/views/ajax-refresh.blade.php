<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="{{ URL::to('css/960.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ URL::to('css/reset.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ URL::to('css/style.css') }}">
<script type="text/javascript">
	$(document).ready(function() {
		var feed_urls = [
			@foreach (Feed::all() as $feed)
				"{{ URL::to("feed/$feed->id/refresh") }}",
			@endforeach
		];
		for (var i = 0; i < feed_urls.length; i++) {
			$.ajax({
				type: "GET",
	  			url: feed_urls[i]
			  });
		}
		window.location = "{{ URL::to('/') }}";
	});
</script>
<div class="container_12">
<div class="loading" style="display: none;">
	<span>Loading...</span>
</div></div>
