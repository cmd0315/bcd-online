@include('layout.partials.header')
	<div id="wrap" class="home-wrap">
		@include('layout.partials.navigation')
		<div id="headerwrap">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-lg-offset-6 box">
						@yield('content')
					</div><!-- /col-lg-6 -->
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .headerwrap -->

		<div id="push"></div>

	</div> <!-- #wrap -->
@include('layout.partials.footer')
