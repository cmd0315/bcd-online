@extends('layout.outer.master')

@section('content')
<h1>Online Forms</h1>
<a href="{{ URL::route('accounts.signin') }}"><button type="button" class="btn btn-lg btn-warning" id="signin" name="signin">Sign in</button></a>
@stop