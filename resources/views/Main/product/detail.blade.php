@extends('Main._layout.basic')

@section('title')
	<title>CHS - Product Detail</title>
@endsection

@section('meta')
	<meta name="title" content="CHS - Product Detail">
	<meta name="description" content="">
	<meta name="keywords" content=""/>
@endsection

@section('include_css')
	<link rel="stylesheet" href="{{ asset('public/main/css/product-list.css') }}">
	<style type="text/css">
		#detail h1,
		#product h1{
			color: rgb(99, 96, 97);
		}

		#detail .bar{
			position: relative;
			padding: 5px 0;
			margin: 30px 0;
			border-bottom: .5px solid;
		}
		#detail .bar .float h2{
			margin: 5px 0;
			color: rgb(7, 26, 66);
			font-size: 22pt;
		}
		#detail .bar .float p{
			line-height: 1.5;
		}
		#detail .bar .float #img{
			width: 80%;
			height: 160px;
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;
		}
		#detail .bar .float:nth-child(odd){
			width: 20%;
			text-align: center;
			float: left;
		}
		#detail .bar .float:nth-child(even){
			width: 80%;
			float: right;
		}
		@media screen and (max-width: 736px) /*and (min-width: 528px)*/ { /* Mobile landscape */
			#detail .bar .float #img,
			#detail .bar .float:nth-child(odd),
			#detail .bar .float:nth-child(even){
				width: 100%;
				float: unset;
			}
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

		<div id="detail">
			<div class="wrapper large-to-medium text-left">
				<h1>{{ $self->name }}</h1>

				@foreach($self->detailPublish as $list)
				<div class="bar">
					<div class="float">
						<div class="tabs">
							<div class="rows">
								<div class="cells">
									<div id="img" style="background-image: url('{{ asset('public/asset/picture/product-detail/'.$list->picture) }}');"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="float">
						<div class="tabs">
							<div class="rows">
								<div class="cells">
									<h2>{{ $list->name }}</h2>
									{!! $list->descript !!}
									<!--<div style="margin: 10px auto;">-->
									<!--    <a class="op_cu btn-link blue small" data-name="{{ $list->name }}">-->
    					<!--				    for more information about our products please contact us-->
    					<!--				</a>-->
									<!--</div>-->
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				@endforeach
			</div>
		</div>

		<div id="product">
			<div class="wrapper large-to-medium text-center">

				<div id="list-item">
				@include('Main._layout.product_list')
				</div>
				<div class="clearfix"></div>
				<br><br><br>
				<div id="info-add-list-item"></div>
				<a id="call-product" class="btn-link blue" href="{{ route('main.product') }}">All Product</a>
			</div>
		</div>

@endsection

@section('include_js')
	
@endsection
