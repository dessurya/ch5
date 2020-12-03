@extends('Main._layout.basic')

@section('title')
	<title>CHS - About Us</title>
@endsection

@section('meta')
	<meta name="title" content="CHS - About Us">
	<meta name="description" content="PT CITRA HARAPAN SUKSES adalah perusahaan distributor Stainless Steel yang berpengalaman dalam bidangnya khususnya pipa bulat dan pipa kotak Stainless Steel grade 201 dan 304. Kami menawarkan berbagai jenis dan ukuran pipa Stainless Steel. Selain melayani penjualan pipa kami juga menerima pengerjaan proyek berbahan Stainless Steel.">
	<meta name="keywords" content="CHS - About Us"/>
@endsection

@section('include_css')
	<link rel="stylesheet" href="{{ asset('public/main/css/product-list.css') }}">
	<style type="text/css">
		#about_us h1{
			color: rgb(99, 96, 97);
		}

		#about_us p{
			line-height: 1.6;
		}
	</style>
@endsection

@section('body')

	<div id="absen_wrapper">
		<img id="absen_logo" class="abs_tri" src="{{ asset('public/asset/picture-default/chs.png') }}">
		<div id="absen_1" class="abs_tri"></div>
		<div id="absen_2" class="abs_tri"></div>
		<div id="absen_4" class="abs_tri"></div>
		<div id="absen_5" class="abs_tri"></div>
		<div id="absen_3" class="abs_tri"></div>
		<!-- <div id="absen_6" class="abs_tri"></div> -->

		<div id="about_us">
			<div class="wrapper large-to-medium text-left">
				<h1>About Us</h1>
				<p>
					PT CITRA HARAPAN SUKSES adalah perusahaan distributor Stainless Steel yang berpengalaman dalam bidangnya khususnya pipa bulat dan pipa kotak Stainless Steel grade 201 dan 304. Kami menawarkan berbagai jenis dan ukuran pipa Stainless Steel. Selain melayani penjualan pipa kami juga menerima pengerjaan proyek berbahan Stainless Steel.
				</p>
				<div class="text-center">
    				<p>Our Brand</p>
    				<img src="{{ asset('public/asset/picture-default/bran_sun.png') }}" style="height=120px; width=auto;">
    				<p>
    					Setiap produk kami dilengkapi dengan Mill Test Certificate.
    				</p>
				</div>
				
			</div>
		</div>

		<div id="product">
			<div class="wrapper large-to-medium text-center">
				<h1>Product</h1>

				@include('Main._layout.product_list')
				<div class="clearfix"></div>
				<br><br><br>
				<a class="btn-link blue" href="{{ route('main.product') }}">More Product</a>
			</div>
		</div>

@endsection

@section('include_js')
	
@endsection
