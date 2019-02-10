@extends('layouts.appmaster')
@section('title', 'Login Page')

@section('content')
<!--- Login Form --->
	<form action="dologin3" method="POST">
		<input type="hidden" name="_token" value = "<?php echo csrf_token()?>">
	<h3>Please Login Into Activity 2 Part 3</h3>
	<table>
	
	<tr>
	<td>Username:</td>
	<td><input type="text" name="username" maxlength="10"/>{{ $errors->first('username')}}</td>
	</tr>
	
	<tr>
	<td>Password:</td>
	<td><input type="password" name="password" maxlength="10"/>{{ $errors->first('password')}}</td>
	</tr>
	
	<tr>
		<td colspan="2" align="center">
		<input type="submit" value="Submit"/></td>
	</tr> 
	</table>
	</form>
	<br/>
	<br/>
	<!-- Display all data validation rule errors -->
	<!-- Note: the use of blade conditions, try not and use php scriplets -->
	@if($errors->count() != 0) 
		<h5>List of Errors: </h5>
		@foreach($errors->all() as $message)
			{{$message}} <br/>
		@endforeach
	@endif	
@endsection