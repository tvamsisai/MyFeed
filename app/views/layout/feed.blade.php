<div class="feedd">
	<div class="name">
		<a href="{{ URL::to('feed/'.$feed->id) }}">{{ $feed->name }}</a>
	</div>
	<div class="url">
		<a href="{{ $feed->url }}" target="_blank">{{ $feed->url }}</a>
	</div>
</div>