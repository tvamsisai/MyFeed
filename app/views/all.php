<!DOCTYPE html>

<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="{{ URL::to('css/960.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ URL::to('css/reset.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ URL::to('css/style.css') }}">
		<title>RSS Feed</title>
		<script>
			
		</script>
	</head>
	<body>
		<div class="container_12">
			<div class="grid_12">
				<div class="nav">
					<div class="nav-item"><a href="{{ URL::to('/') }}">Home</a></div>
					<div class="nav-item"><a href="{{ URL::to('feeds') }}">Feeds</a></div>
					<div class="search">
						<form method="GET" action="{{ URL::to('search') }}">
							<input type="text" placeholder="Search" name="q"></input>
						</form>
					</div>
					<a href="{{ URL::to('add') }}" class="button">Add</a>
				</div>
			</div>
			<div class="grid_12">
				<div class="content">
					<div class="article">
						<div class="vote">
							<div class="up">&#x25B2;</div>
							<div class="down">&#x25BC;</div>
						</div>
						<div class="title">
							<a href="#">Title</a>
						</div>
						<div class="feed">
							<a href="#">(Feed Name)</a>
						</div>
						<div class="keywords">
							<a href="#" class="keyword">keyword1</a>
							<a href="#" class="keyword">keyword2</a>
						</div>
						<div class="published">
							<span class="ago">2 months ago</span>
						</div>
					</div>
					<div class="article viewed">
						<div class="vote up">
							<div>&#x25B2;</div>
						</div>
						<div class="title">
							<a href="#">Title</a>
						</div>
						<div class="feed">
							<a href="#">(Feed Name)</a>
						</div>
						<div class="keywords">
							<a href="#" class="keyword">keyword1</a>
							<a href="#" class="keyword">keyword2</a>
						</div>
						<div class="published">
							<span class="ago" time=" | 2 Oct">2 months ago</span>
						</div>
					</div>
					<div class="article viewed">
						<div class="vote down">
							<div><br/>&#x25BC;</div>
						</div>
						<div class="title">
							<a href="#">Title</a>
						</div>
						<div class="feed">
							<a href="#">(Feed Name)</a>
						</div>
						<div class="keywords">
							<a href="#" class="keyword">keyword1</a>
							<a href="#" class="keyword">keyword2</a>
						</div>
					</div>
					<div class="feedd">
						<div class="name">
							<a href="#">Feed Name</a>
						</div>
						<div class="url">
							<a href="#">url</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>