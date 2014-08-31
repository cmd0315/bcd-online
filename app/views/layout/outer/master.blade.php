@include('layout.partials.header')
	<div id="wrap">
		@include('layout.partials.navigation')
		@yield('content')

		<div id="push"></div>

	</div> <!-- #wrap -->
@include('layout.partials.footer')
