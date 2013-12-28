<div class="pagination">
	@if($count >= 30)
		@if($count / 30 <= 40)
			@for($i = 0; $i < ceil($count / 30.0); $i++)
				<a href="{{ $page.'?page='.$i }}">{{ $i+1 }}</a>
			@endfor
		@else
			@if(Input::get('page') < 15 || Input::get('page') > ceil($count / 30.0)-20)
				@for($i = 0; $i < 20; $i++)
					<a href="{{ $page.'?page='.$i }}">{{ $i+1 }}</a>
				@endfor
				<span>...</span>
				@for($i = ceil($count / 30.0)-20; $i < ceil($count / 30.0); $i++)
					<a href="{{ $page.'?page='.$i }}">{{ $i+1 }}</a>
				@endfor
			@else
				@for($i = 0; $i < 5; $i++)
					<a href="{{ $page.'?page='.$i }}">{{ $i+1 }}</a>
				@endfor
				<span>...</span>
				@for($i = Input::get('page')-5; $i < Input::get('page')+5; $i++)
					<a href="{{ $page.'?page='.$i }}">{{ $i+1 }}</a>
				@endfor
				<span>...</span>
				@for($i = ceil($count / 30.0)-5; $i < ceil($count / 30.0); $i++)
					<a href="{{ $page.'?page='.$i }}">{{ $i+1 }}</a>
				@endfor
			@endif
		@endif
	@endif
</div>