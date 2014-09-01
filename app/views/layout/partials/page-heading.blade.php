<div class="container">
	<div class="row mt2">
		<div class="col-lg-12">
			@yield('breadcrumb')
		</div>
	</div>
	<div class="row centered">
		<div class="col-lg-6 col-lg-offset-3">
			<h1>{{$pageTitle}}</h1>

			@if(Session::has('global'))
				<div class="alert alert-info">
					<p class="emphasize"> {{ Session::get('global') }} </p>
				</div>
			@elseif(Session::has('global-error'))
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<p class="emphasize"> {{ Session::get('global-error') }} </p>
				</div>
			@elseif(Session::has('global-successful')) 
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<p class="emphasize"> {{ Session::get('global-successful') }} </p>
				</div>
			@endif

			@yield('heading')
		</div>
	</div><!-- /row -->