@extends('layouts.appmaster')
@section('title', 'Login Success Page')

@section('content')
	@if($model->getUsername() == 'EmilyQ')
		<h3>Emily, you have logged in</h3>
	@else
		<h3>Someone else besides Emily has logged in</h3>
	@endif
	<br>
	<a href="login2">Login Again</a>
@endsection