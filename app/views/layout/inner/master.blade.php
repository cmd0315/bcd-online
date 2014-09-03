@include('layout.partials.header')
	<div id="wrap">
		@include('layout.partials.navigation')

		@include('layout.partials.page-heading')
			@yield('content')
		
			</div><!-- .container -->
		<div id="push"></div>

	</div> <!-- #wrap -->
	<!-- .modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	  	@yield('modal-content')
	  </div>
	</div>
	<!-- /.modal -->
@include('layout.partials.footer')
