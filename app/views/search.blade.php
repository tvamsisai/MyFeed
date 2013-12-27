@extends('layout.layout')

@if($results != '')
	@section('content')
		@foreach($results as $keyword)
			@include('layout.article', array('article'=> $keyword->article))
		@endforeach
	@stop
@else
	@section('content')
		No Results
	@stop
@endif