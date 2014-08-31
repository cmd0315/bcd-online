@extends('layout.outer.master')

@section('content')
	<div id="headerwrap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<h1>Online Forms</h1>
		          	<a href="{{ URL::route('accounts.signin') }}"><button type="button" class="btn btn-lg btn-warning" id="signin" name="signin">Sign in</button></a>
				</div><!-- .col-lg-6 -->
			</div><!-- /row -->
		</div><!-- /container -->
	</div><!-- /headerwrap -->
@stop