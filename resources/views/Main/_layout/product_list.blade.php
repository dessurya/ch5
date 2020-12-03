@foreach($product as $list)
<div class="bar">
	<div id="spacing">
		<a href="{{ route('main.product.detail', ['id'=>$list->slug]) }}">
			<div id="show">
				<div id="img" style="background-image: url('{{ asset('public/asset/picture/product/'.$list->picture) }}');">
					<div class="tabs">
						<div class="rows">
							<div class="cells">
								<h3>{{ $list->name }}</h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>	
</div>
@endforeach