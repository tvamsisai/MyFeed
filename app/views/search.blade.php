@extends('layout.layout')

@if($results != '')
	@section('content')
		@foreach($results as $keyword)
			@include('layout.article', array('article'=> $keyword->article))
		@endforeach

		@include('layout.paginate', array('count'=> $count, 'page' => URL::current()))
	@stop
@else
	@section('content')
		No Results
	@stop
@endif