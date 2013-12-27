@extends('layout.layout')

@if($articles)
	@section('content')
		@foreach($articles as $article)
			@include('layout.article', array('article'=> $article))
		@endforeach
	@stop
@endif