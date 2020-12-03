@extends('Main._layout.basic')

@section('title')
	<title>CHS - Service</title>
@endsection

@section('meta')
	<meta name="title" content="CHS - Service">
	<meta name="description" content="">
	<meta name="keywords" content="CHS - Service"/>
@endsection

@section('include_css')
	<link rel="stylesheet" href="{{ asset('public/main/css/product-list.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/main/vendor/baguetteBox/baguetteBox.min.css') }}">

	<style type="text/css">
		#service h1,
		#service h2{
			color: rgb(99, 96, 97);
		}

		#service p{
			line-height: 1.6;
		}

		#service .bar{
			position: relative;
			padding: 50px 0;
		}
		#service .bar .float h2{
			margin: 5px 0;
		}
		#service .bar .float p{
			line-height: 1.5;
		}
		#service .bar .float img{
			width: 80%;
		}
		#service .bar .float .imgs{
			position: relative;
			margin: 20px auto;
			display: inline-block;
			width: 48%;
			height: 180px;

			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}
		#service .bar .float .imgs .tabs,
		#service .bar .float .imgs .tabs .rows,
		#service .bar .float .imgs .tabs .rows .cells{
			width: 100%;
			vertical-align: bottom;
			height: 180px;
		}
		#service .bar .float .imgs .tabs .rows .cells h4{
			margin: 0;
			padding: 7px 0;
			background-color: rgba(215, 3, 0, .6);
			color: rgb(12, 23, 41);
			text-transform: uppercase;
		}
		#service .bar .float:nth-child(odd){
			width: 70%;
		}
		#service .bar .float:nth-child(even){
			width: 30%;
			/*background-color: gray;*/
			text-align: center;
		}
		#service .bar:nth-child(odd) .float:nth-child(odd){
			float: left;
		}
		#service .bar:nth-child(even) .float:nth-child(odd){
			float: right;
		}
		#service .bar:nth-child(odd) .float:nth-child(even){
			float: left;
		}
		#service .bar:nth-child(even) .float:nth-child(even){
			float: right;
		}
		#service .bar:nth-child(odd) .float h2{
			font-size: 24pt;
		}
		#service .bar:nth-child(odd) .float{
			text-align: right;
		}
		@media screen and (max-width: 736px) /*and (min-width: 528px)*/ { /* Mobile landscape */
			#service .bar{
				padding: 20px 0;
			}
			#service .bar .float:nth-child(odd),
			#service .bar .float:nth-child(even){
				width: 100%;
			}
			#service .bar:nth-child(odd) .float:nth-child(odd),
			#service .bar:nth-child(even) .float:nth-child(odd),
			#service .bar:nth-child(odd) .float:nth-child(even),
			#service .bar:nth-child(even) .float:nth-child(even){
				float: unset;
			}
			#service .bar .float .imgs{
				width: 100%;
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

		<div id="service">
			<div class="wrapper large-to-medium text-left">
				<h1>Service</h1>
				<div class="bar">
					<div class="float">
						<div class="tabs">
							<div class="rows">
								<div class="cells">
									<h2>Shipping</h2>
									<p>
										Kami melayani pengiriman pesanan jabodetabek dengan beban maksimal 10 ton dalam sekali pengiriman.
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="float">
						<div class="tabs">
							<div class="rows">
								<div class="cells">
									<img src="{{ asset('public/asset/picture-default/s2_shipping.png') }}">
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>

				<div class="bar">
					<div class="float">
						<div class="tabs">
							<div class="rows">
								<div class="cells">
									<h2>Jasa Finishing Poles</h2>
									<p>
										Produk kami dapat dipoles hairline dan mirror sesuai permintaan.
									</p>
									<div class="imgs" style="background-image: url('{{ asset('public/asset/picture-default/s_hairline.png') }}');">
										<div class="tabs">
											<div class="rows">
												<div class="cells text-center">
													<h4>hairline</h4>
												</div>
											</div>
										</div>
									</div>
									<div class="imgs" style="background-image: url('{{ asset('public/asset/picture-default/s_mirror.png') }}');">
										<div class="tabs">
											<div class="rows">
												<div class="cells text-center">
													<h4>mirror</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="float">
						<div class="tabs">
							<div class="rows">
								<div class="cells">
									<img src="{{ asset('public/asset/picture-default/s2_finising.png') }}">
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>

		<div id="product">
			<div class="wrapper large-to-medium text-center">
				<h1>Project</h1>
				<div id="baguetteBox">
					@foreach($project as $list)
					<div class="bar">
						<div id="spacing">
							<a href="{{ asset('public/asset/picture/project/'.$list->picture) }}">
								<div id="show">
									<div id="img" style="background-image: url('{{ asset('public/asset/picture/project/'.$list->picture) }}');"></div>
								</div>
							</a>
						</div>	
					</div>
					@endforeach
				</div>
				<div class="clearfix"></div>
				<br><br><br>
				<a id="getmore" class="btn-link blue" href="{{ route('main.projectList') }}">More Project</a>
			</div>
		</div>

@endsection

@section('include_js')
	<script src="{{ asset('public/main/vendor/baguetteBox/baguetteBox.min.js') }}"></script>
	<script type="text/javascript">
		baguetteBox.run('#baguetteBox');

		$(function(){
			var page = 1;
			// $('#more p').hide();
			$(document).on('click', 'a#getmore', function(){
				page += 1;
				var url = $(this).attr('href')+'?page='+page;
		        $.ajax({
		            url: url,
		            type: 'get',
		            beforeSend: function() {
		                // $('#more p').show()
		                // $('#more p label').html('Please Wait ... Currently Taking Your Request ... Please Wait ...');
		            },
		            success: function(data) {
		            	if (data.html) {
		            		window.setTimeout(function() {
		                        $('#baguetteBox').append(data.html);
		                    }, 350);
		                    window.setTimeout(function() {
		                        baguetteBox.run('#baguetteBox');
		                    }, 500);
		            	}
		            	else if(!data.html){
		            		window.setTimeout(function() {
		                		$('a#getmore').hide();
		                    }, 350);
		              //       window.setTimeout(function() {
				            //     $('#more p label').html('All Data Has Been Loaded');
		              //       }, 475);
		            	}
	                    // window.setTimeout(function() {
	                    //     $('#more p').hide();
	                    // }, 2875);
		            }
		        });
		        return false;
			});
		});
	</script>
@endsection
