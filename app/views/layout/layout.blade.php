<!DOCTYPE html>
<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="{{ URL::to('css/960.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ URL::to('css/reset.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ URL::to('css/style.css') }}">
		<title>MyFeed</title>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="{{ URL::to('cookie.js') }}"></script>
		<script>
			var createNotif, article, feed, i = 0, j = 0, notification = new Array();
			$(document).ready(function () {
				<?
					if(Article::all()->count() > 0)
						$lastArticle = Article::orderBy('id', 'DESC')->first()->id;
					else
						$lastArticle = 0;
				?>
				var have = {{ $lastArticle }};
				var knownNew = 0;
				createNotif = function  (stuff) {
					if (window.webkitNotifications.checkPermission() == 0) {
						$.getJSON("{{ URL::to('article') }}/"+ ((+stuff)+(have)) +'.json',
							function(data) {
								article = data;
								$.getJSON("{{ URL::to('feed') }}/"+ article.feed_id +'.json',
									function(data) {
										feed = data;
										notification[i] = window.webkitNotifications.createNotification(
					      					'', article.title, feed.name);
										notification[i].onclick = function () {
											window.open(article.url);
											notification[i].close();
										}
										if($.cookie('close') != 0)
						    				setTimeout(function () {
						    					notification[j++].close();
						    				}, +$.cookie('close')*1000);

					    				notification[i++].show();
								});
						});
					} else {
						window.webkitNotifications.requestPermission();
					}
				}

				$("#refresh").click(function () {
					$(".loading").show();
					refreshFeeds();
					setTimeout(function () {
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
							if(data > knownNew) {
								if(data - knownNew < 3)
									for (var i = ((knownNew == 0)?1:(+knownNew)+1); i <= data; i++) {
										createNotif(i);
								};
							}
							knownNew = data;
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

				if(window.webkitNotifications.checkPermission() == 0) {
					$('#notifs').hide();
				}

				$('#notifs').click(function () {
					window.webkitNotifications.requestPermission();
					if(window.webkitNotifications.checkPermission() == 0)
						$('#notifs').hide();
				});

				$('.close-popup').change(function () {
					$.cookie('close', $('.close-popup').val());
				});

				$('.close-popup').val($.cookie('close'));

				$('.up').click(function () {
					$.ajax({
						url: '{{ URL::to("article") }}/'+$(this).attr('data-id')+'/vote/1',
						success: $.proxy(function(data){
							$(this).addClass('voted');
						}, this)
					});
				});

				$('.down').click(function () {
					$.ajax({
						url: '{{ URL::to("article") }}/'+$(this).attr('data-id')+'/vote/-1',
						success: $.proxy(function(data){
							$(this).addClass('voted');
						}, this)
					});
				});

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
					<div class="nav-item"><a href="{{ URL::to('/?by=recent') }}">Recent</a></div>
					<div class="nav-item"><a href="{{ URL::to('feeds') }}">Feeds</a></div>
					<div class="search">
						<form method="GET" action="{{ URL::to('search') }}">
							<input type="text" placeholder="Search" name="q" value="{{ Input::get('q') }}"></input>
						</form>
					</div>
					<a href="#" class="button" id="refresh">Refresh</a>
					<a href="{{ URL::to('add') }}" class="button">Add Feed</a>
					<a href="#" class="button" id="notifs">Popup</a>
				</div>
			</div>
			<div class="grid_12">
				<div class="content">
					@yield('content', '<p style="text-align: center;">Add Some Feeds to See Stuff Here.</p>')
				</div>
			</div>
			<div class="grid_12">
				<div class="footer">
					Close Popup in: <input class="close-popup" value="0" style="width:30px;text-align:center;"></input>seconds | (0 is don't close)
				</div>
			</div>
		</div>
	</body>
</html>