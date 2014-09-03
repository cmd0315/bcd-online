	<div id="footer">
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-lg-8" id="breadcrumb-footer-area">
						@yield('breadcrumb')
					</div>
					<div class="col-lg-4" id="footer-text">
						<p> BCD Pinpoint Direct Marketing Inc. &copy; 2014 </p>
					</div>
				</div>
			</div>
		</footer>
	</div> <!-- #footer -->


	<!-- js -->
	{{ HTML::script('https://code.jquery.com/jquery-1.10.2.min.js') }}
	{{ HTML::script('js/bootstrap.min.js') }}
	@yield('scripts')
</body>
</html>