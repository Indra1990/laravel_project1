@extends('layouts.app')

@section('content')
<div class="container">
	<div class="jumbotron">
		<h1> {{$quote->title}} </h1>
		<p> {{$quote->subject}}</p>
		<p>Di Tulis Oleh : {{$quote->user->name}}</p>

		<p><a href="/quotes" class="btn btn-primary btn-lg">kembali ke index</a></p>
		@if($quote->isOwner())
			<p><a href="/quotes/{{$quote->id}}/edit" class="btn btn-primary btn-lg"> Edit</a></p>

			<form action="/quotes/{{ $quote->id }}" method="POST">
			{{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" class="btn btn-danger btn-lg" value="Delete">
		</form>

		@endif
	</div>	
</div>
@endsection

