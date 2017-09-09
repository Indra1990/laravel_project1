@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>{{$user->name}}</h2></div>
                <div class="panel-body">
                <ul class="list-group">
                @foreach($user->quotes as $quote )
                    <li class="list-group-item"><a href="/quotes/{{$quote->slug}}">{{ $quote->title }}</a></li>
                @endforeach    
                </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
