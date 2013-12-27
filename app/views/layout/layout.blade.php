<!DOCTYPE html>
<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="{{ URL::to('css/960.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ URL::to('css/reset.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ URL::to('css/style.css') }}">
		<title>MyFeed</title>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script>
			$(document).ready(function () {
				var have = {{ Article::orderBy('id', 'DESC')->first()->id }};
				$("#refresh").click(function () {
					$(".loading").show();
					refreshFeeds();
					setInterval(function () {
						for (var i = 0; i < 10000; i++) {};
					}, 10000);
					window.location = "{{ URL::to('/') }}";
				});
				function checkNew() {
					$.ajax({
						type: "GET",
						url: "{{ URL::to('new') }}?have="+have
					}).done(function (data) {
						if(data > 0) {
							$('#refresh').html('Refresh <span>'+ data +'</span>');
							$('title').html('('+ data +') MyFeed');
						}
					});
					setTimeout(checkNew, 10000);
				}
				function refreshFeeds () {
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
					setTimeout(refreshFeeds, 5000);
				}

				refreshFeeds();
				checkNew();
			});
		</script>
	</head>
	<body>
		<div class="container_12">
			<div class="loading" style="display: none;">
				<span>Loading...</span>
			</div>
			<div class="grid_12">
				<div class="nav">
					<div class="nav-item"><a href="{{ URL::to('/') }}">Home</a></div>
					<div class="nav-item"><a href="{{ URL::to('feeds') }}">Feeds</a></div>
					<div class="search">
						<form method="GET" action="{{ URL::to('search') }}">
							<input type="text" placeholder="Search" name="q" value="{{ Input::get('q') }}"></input>
						</form>
					</div>
					<a href="#" class="button" id="refresh">Refresh</a>
					<a href="{{ URL::to('add') }}" class="button">Add Feed</a>
				</div>
			</div>
			<div class="grid_12">
				<div class="content">
					@yield('content', '<p style="text-align: center;">Add Some Feeds to See Stuff Here.</p>')
				</div>
			</div>
		</div>
	</body>
</html>