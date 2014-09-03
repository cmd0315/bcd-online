@extends('layout.outer.master')

@section('content')
<h1>Sign in</h1>
@if(Session::has('global'))
	<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<p class="emphasize"> {{ Session::get('global') }} </p>
	</div>
@endif
<form role="form" method="post" action="{{ URL::route('accounts.signin-post') }}">
	<div class="form-group">
		<label for="username" class="home-label">Username</label>
		<input type="text" class="form-control" id="username" name="username"{{ (Input::old('username')) ? ' value ="' . Input::old('username') . '"' : '' }}>
		@if($errors->has('username'))
			<p class="text-danger emphasize">{{ $errors->first('username') }}</p>
		@endif
	</div>
	<div class="form-group">
		<label for="password" class="home-label">Password</label>
		<input type="password" class="form-control" id="password" name="password"{{ (Input::old('password')) ? ' value ="' . Input::old('password') . '"' : '' }}>
		@if($errors->has('password'))
			<p class="text-danger emphasize">{{ $errors->first('password') }}</p>
		@endif
	</div>
	<div class="form-group">
      <div class="checkbox">
        <label for="remember" class="home-label">
          <input type="checkbox" name="remember" id="remember"> Remember me
        </label>
      </div>
	 </div>
	<input type="submit" name="submit" id="submit" class="btn btn-lg btn-warning" value="Sign in"/>
	{{ Form::token() }}
</form>
@stop