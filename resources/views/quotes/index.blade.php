@extends('layouts.app')

@section('content')
<div class="container">

	@if(session('msg'))
	<div class="alert alert-success">
		<p>{{ session('msg') }}</p>
	</div>
	@endif 
	
	<div class="row">
		@foreach($quotes as $quote)
		<div class="col-md-4">
			<div class="thumbnail">
				<div class="caption">{{ $quote->title}}</div>
				<p><a href="/quotes/{{$quote->slug}}" class="btn btn-primary"> Lihat Kutipan</a></p>
			</div>
		</div>
		@endforeach
	</div>
</div>

@endsection
