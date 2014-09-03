@include('layout.partials.header')
	<div id="wrap">
		@include('layout.partials.navigation')
		<div class="container-fluid" id="profile-header">
			<div class="row mt3">
				<div class="container">
					@yield('header-content')
				</div>
			</div>
		</div><!-- .container -->
		<div id="push"></div>

	</div> <!-- #wrap -->
@include('layout.partials.footer')
