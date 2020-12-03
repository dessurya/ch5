<div id="navigasibar">
	<div class="wrapper large">
		<div class="float-left">
			<div class="bar">
				<div class="item {{ route::is('main.home') ? 'active' : '' }}">
					<a href="{{ route('main.home') }}">
						<img id="logo" src="{{ asset('public/asset/picture-default/chs.png') }}">
					</a>
				</div>
			</div>
		</div>
		<div class="float-right">
			<div class="bar">
				<div class="item {{ route::is('main.home') ? 'active' : '' }}">
					<a href="{{ route('main.home') }}">
						Home
					</a>
				</div>
				<div class="item {{ route::is('main.about_us') ? 'active' : '' }}">
					<a href="{{ route('main.about_us') }}">
						About Us
					</a>
				</div>
				<div class="item {{ route::is('main.product') ? 'active' : '' }}">
					<a href="{{ route('main.product') }}">
						Product
					</a>
				</div>
				<div class="item {{ route::is('main.service') ? 'active' : '' }}">
					<a href="{{ route('main.service') }}">
						Service
					</a>
				</div>
				<div class="item">
					<a id="op_cu">
						Contact Us
					</a>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div id="burger-icon">
			<div></div>
			<div></div>
			<div></div>
		</div>
	</div>	
</div>