@extends('Main._layout.basic')

@section('title')
	<title>CHS - Product</title>
@endsection

@section('meta')
	<meta name="title" content="CHS - Product">
	<meta name="description" content="">
	<meta name="keywords" content="CHS - Product"/>
@endsection

@section('include_css')
	<link rel="stylesheet" href="{{ asset('public/main/css/product-list.css') }}">
	<style type="text/css">
		#product h1{
			color: rgb(99, 96, 97);
		}

		#product p{
			line-height: 1.6;
		}
		#info-add-list-item{
			margin: 20px 0;
			padding: 5px 10px;
			text-align: center;
			width: 100%;
			position: relative;
			border-radius: 5px;
			background-color: rgba(229, 78, 79, .8);
			display: none;
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

		<div id="product">
			<div class="wrapper large-to-medium text-center">
				<h1>Product</h1>

				<div id="list-item">
				@include('Main._layout.product_list')
				</div>
				<div class="clearfix"></div>
				<p><small>*For More Info Click The Image Above</small></p>
				<br><br><br>
				<div id="info-add-list-item"></div>
				<a id="call-product" class="btn-link blue" href="{{ route('main.product.call') }}">More Product</a>
			</div>
		</div>

@endsection

@section('include_js')
	<script type="text/javascript">
		$(function(){
			var page = 1;
			$(document).on('click', 'a#call-product', function(){
				page += 1;
				$('#info-add-list-item').hide();
				var url = $(this).attr('href')+'?page='+page;
				// console.log(page);
				// console.log(url);
		        $.ajax({
		            url: url,
		            type: 'get',
		            beforeSend: function() {
		                $('#info-add-list-item').show().html('<label>Mohon Tunggu... Sedang Mengambil Permintaan Anda... Mohon Tunggu...</label>');
		            },
		            success: function(data) {
		            	// console.log(data);
		            	if (data.html) {
		            		window.setTimeout(function() {
		                        $('#list-item').append(data.html);
		                    }, 350);
		                    window.setTimeout(function() {
		                        $('#info-add-list-item').hide().html('');
		                    }, 1675);
		            	}
		            	else if(!data.html){
		            		window.setTimeout(function() {
		                		$('a#add-list-item').hide();
		                    }, 350);
		                    window.setTimeout(function() {
		                        $('#info-add-list-item').show().html('<label>Semua Data Telah Di Muat...</label>');
		                    }, 475);
		                    window.setTimeout(function() {
		                        $('#info-add-list-item').hide().html('');
		                    }, 1675);
		            	}
		            }
		        });
		        return false;
			});
		});
	</script>
@endsection
