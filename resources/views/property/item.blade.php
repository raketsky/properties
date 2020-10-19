@extends('master')

@section('title')
	{{$property->uuid}}
@endsection

@section('content')
	<div class="list-group">
		<h3>{{$property->uuid}}</h3>
		
		@foreach($attributes as $attribute)
		<a href="#" class="list-group-item list-group-item-action">
			<div class="d-flex w-100 justify-content-between">
				<h5 class="mb-1">{{$attribute['title']}}</h5>
			</div>
			<p class="mb-1">{{$attribute['value']}}</p>
		</a>
		@endforeach
	</div>
@endsection