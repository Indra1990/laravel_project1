@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css/search.css') }}">
<div class="container">
	{{-- message from CRUD quote --}}
	@if(session('msg'))
	<div class="alert alert-success">
		<p>{{ session('msg') }}</p>
	</div>
	{{-- message aktivasi register from email  --}}
	@endif 
	@if(session('actived'))
	<div class="alert alert-success">
		<p>{{ session('actived') }}</p>
	</div>
	@endif 
	<div class="row">
		<div class="col-md-4">
			<div class="btn-group">
				<a href="/quotes/random" class="btn btn-primary">Random</a> 
				<a href="/quotes/create" class="btn btn-primary">Create Kutipan</a>
				<a href="/quotes" class="btn btn-primary">All</a> 
			</div>
		</div>
		<div class="col-md-4">
			<form action="/quotes" class="search-form" method="get">
                 <div class="input-group stylish-input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search" >
                    <span class="input-group-addon">
                        <button type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>  
                    </span>
                </div>
            </form>
		</div>
		<div class="col-md-4">
			<b>Filter Tag :</b>
			@foreach ($tags as $tag)				
			<a href="/quotes/filter/{{ $tag->tag_name }}">/{{ $tag->tag_name }}</a>
			@endforeach
		</div>
	</div>

	<br>
	<div class="row">
		@foreach($quotes as $quote)
		<div class="col-md-4">
			<div class="thumbnail">
				<span><div class="caption"><b>{{$quote->title}}</b>	</div></span>
				<span><b>Tags : </b>
				@foreach ($quote->tags as $tag)					
				<span>{{ $tag->tag_name }},</span>
				@endforeach
				</span>
				<p><a href="/quotes/{{$quote->slug}}" class="btn btn-primary">Lihat Kutipan</a></p>
			</div>
		</div>
		@endforeach
	</div>
</div>

@endsection
