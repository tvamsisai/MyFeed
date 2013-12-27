@extends('layout.layout')

@if($feeds)
	@section('content')
		@foreach($feeds as $feed)
			@include('layout.feed', array('feed'=> $feed))
		@endforeach
	@stop
@endif