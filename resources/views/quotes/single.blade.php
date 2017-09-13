@extends('layouts.app')

@section('content')
	<link href="{{ asset('css/comments.css') }}" rel="stylesheet">

<div class="container">
	<div class="jumbotron">
		<h1> {{$quote->title}} </h1>
		<p> {{$quote->subject}}</p>
		<p>Di Tulis Oleh : <a href="/profile/{{$quote->user->id}}">{{$quote->user->name}}</a></p>

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

	@if(session('msg'))
		<div class="alert alert-success">
		<p>{{ session('msg') }}</p>
		</div>
	@endif

	{{--komentar--}}
	@foreach($quote->comments as $comment)
	 <div class="comment-box">
			<h4 class="title">Ditulis Oleh : <a href="/profile/{{$comment->user->id}}"> {{ $comment->user->name}}</a></h4>
			{{ $comment->subject	}}
	</div>
		@if($comment->isOwner())
			<p><a href="/comment/{{$comment->id}}/edit" class="btn btn-primary btn-lg"> Edit</a></p>

			<form action="/comment/{{ $comment->id }}" method="POST">
			{{ csrf_field() }}
						<input type="hidden" name="_method" value="DELETE">
						<input type="submit" class="btn btn-danger btn-lg" value="Delete">
		</form>
		@endif
	@endforeach

	 	@if(count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
        @endif

		<form action="/comment/{{$quote->id}}" method="POST">
			{{ csrf_field() }}
			<div class="form-group">
			<label for="subject">Isi Komentar</label>
			<textarea class="form-control" name="subject" rows="8" cols="80"></textarea>
			</div>
            <input type="submit" class="btn btn-primary " value="Submit Komentar">
		</form>
</div>
@endsection
