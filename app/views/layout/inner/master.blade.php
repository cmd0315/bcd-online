@include('layout.partials.header')
	<div id="wrap">
		@include('layout.partials.navigation')

		@include('layout.partials.page-heading')
			@yield('content')
		
		<div class="row mt2">
			<div class="col-lg-12">
				@yield('breadcrumb')
			</div>
		</div>
			</div><!-- .container -->
		<div id="push"></div>

	</div> <!-- #wrap -->
@include('layout.partials.footer')
