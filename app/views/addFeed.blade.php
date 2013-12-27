@extends('layout.layout')

@section('content')
	<form action="{{ URL::to('/add') }}" method="POST">
		<label>RSS URL:<br/><input type="text" name="url"></input></label><br/><br/>
		<label>Name:<br/><input type="text" name="feed-name"></input></label><br/><br/>
		<input type="submit"></input>
	</form>
@stop