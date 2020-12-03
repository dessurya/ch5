@extends('Main._layout.basic')

@section('title')
	<title>CHS</title>
@endsection

@section('meta')
	<meta name="title" content="CHS">
	<meta name="description" content="PT CITRA HARAPAN SUKSES adalah perusahaan distributor Stainless Steel yang berpengalaman dalam bidangnya khususnya pipa bulat dan pipa kotak Stainless Steel grade 201 dan 304. Kami menawarkan berbagai jenis dan ukuran pipa Stainless Steel. Selain melayani penjualan pipa kami juga menerima pengerjaan proyek berbahan Stainless Steel.">
	<meta name="keywords" content="CHS"/>
@endsection

@section('include_css')
	<link rel="stylesheet" href="{{ asset('public/main/css/home.css') }}">
	<link rel="stylesheet" href="{{ asset('public/main/css/product-list.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/main/vendor/owl-carousel/owl.carousel.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/main/vendor/owl-carousel/owl.theme.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/main/vendor/owl-carousel/owl.transitions.css') }}">
@endsection

@section('body')
	<div id="banner">
		<div id="banner_picture">
			@foreach($banner as $list)
			<div class="item">
				<div id="img" style="background-image: url('{{ asset('public/asset/picture/banner/'.$list->picture) }}');">
					<div id="description">
						<div class="tabs">
							<div class="rows">
								<div class="cells text-center">
									@if($list->text_one)
									<h1>{{ $list->text_one }}</h1>
									@endif
									@if($list->text_two)
									<p>{{ $list->text_two }}</p>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		<div id="banner_logo">
			<div id="absen_bc"></div>
			<img id="logo" src="{{ asset('public/asset/picture-default/chs.png') }}">
		</div>
	</div>

	<div id="absen_wrapper">
		<div id="absen_3" class="abs_tri"></div>
		<div id="absen_1" class="abs_tri"></div>
		<div id="absen_2" class="abs_tri"></div>
		<div id="absen_4" class="abs_tri"></div>
		<div id="absen_5" class="abs_tri"></div>
		<div id="absen_6" class="abs_tri"></div>

		<div id="about_us">
			<div class="wrapper medium text-center">
				<h1>About Us</h1>
				<p>
					PT CITRA HARAPAN SUKSES adalah perusahaan distributor Stainless Steel yang berpengalaman dalam bidangnya khususnya pipa bulat dan pipa kotak Stainless Steel grade 201 dan 304. Kami menawarkan berbagai jenis dan ukuran pipa Stainless Steel. Selain melayani penjualan pipa kami juga menerima pengerjaan proyek berbahan Stainless Steel.
				</p>
				<br><br><br>
				<a class="btn-link red" href="{{ route('main.about_us') }}">Detail</a>
			</div>
		</div>

		<div id="product">
			<div class="wrapper medium text-center">
				<h1>Product</h1>
				@include('Main._layout.product_list')
				<div class="clearfix"></div>
				<p><small>*For More Info Click The Image Above</small></p>
				<br><br><br>
				<a class="btn-link blue" href="{{ route('main.product') }}">Detail</a>
			</div>
		</div>

		<div id="service">
			<div class="wrapper medium text-center">
				<h1 style="color: rgb(99, 96, 97);">Service</h1>
				<div id="list">
					<div class="bar text-center">
						<img src="{{ asset('public/asset/picture-default/s_shipping.png') }}">
						<h2>Shipping</h2>
					</div>
					<div class="bar">
						<img src="{{ asset('public/asset/picture-default/s_finising.png') }}">
						<h2>Jasa Finishing Poles</h2>
					</div>
				</div>
				<br><br><br>
				<a class="btn-link red" href="{{ route('main.service') }}">Detail</a>
			</div>
		</div>
	</div>
@endsection

@section('include_js')
	<script type="text/javascript" src="{{ asset('public/main/vendor/owl-carousel/owl.carousel.min.js') }}"></script>
	<script type="text/javascript">
		$("#banner #banner_picture").owlCarousel({
			navigation : false,
			items: 1,
			singleItem:true,
			pagination:true,
			autoPlay: 3000,
		    stopOnHover:false
		});
	</script>
@endsection
