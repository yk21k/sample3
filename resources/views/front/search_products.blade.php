@extends('front.layout.layout')
@section('content')

<div class="table-responsive">
	<table class="table" style="width: 1000px; max-width: 0 auto;">
		<tr class="table-info">
			<th scope="col"><small>Image:</small></th>
			<th scope="col"><small>Name:</small></th>
			<th scope="col"><small>Price:</small></th>
		</tr>
		@foreach($searchPosts as $searchProduct)
		<tr>
			<td><image style="width: 80px;"></image></td>
			<td>{{ $searchProduct->product_name }}</td>
			<td>{{ $searchProduct->final_price }}</td>
		</tr>
		@endforeach
	</table>
</div>

@endsection