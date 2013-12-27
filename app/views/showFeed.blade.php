@extends('layout.layout')

@if($articles != "")
	@section('content')
		@include('layout.feed', array('feed'=> $feed))
		<br/>
		@foreach($articles as $article)
			@include('layout.article', array('article'=> $article))
		@endforeach
	@stop
@endif