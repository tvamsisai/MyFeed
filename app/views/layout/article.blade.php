<div class="article">
	<div class="vote">
		<div data-id="{{ $article->id }}" class="up @if($article->vote > 0)voted@endif">&#x25B2;</div>
		<div data-id="{{ $article->id }}" class="down @if($article->vote < 0)voted@endif">&#x25BC;</div>
	</div>
	<div class="title">
		<a href="{{ $article->url }}" target="_blank">{{ $article->title }}</a>
	</div>
	<div class="feed">
		<a href="{{ URL::to('feed/'.$article->feed->id) }}">{{ $article->feed->name }}</a>
	</div>
	<div class="keywords">
		@foreach($article->keywords as $keyword)
			<a href="{{
			 URL::to('search?q='.Word::find($keyword->keyword_id)->word) }}" 
			 class="keyword">{{ Word::find($keyword->keyword_id)->word }}</a>
		@endforeach
	</div>
	<div class="published">
		<span class="ago" time=" | {{ $article->getTimePub()->toDayDateTimeString() }}">{{ $article->getTimePub()->diffForHumans(Carbon::now()) }}</span>
	</div>
</div>