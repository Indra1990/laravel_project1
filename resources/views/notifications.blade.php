@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Halaman Notification </h2></div>
                <div class="panel-body">
                  <ul class="list-group">
                    @foreach ($notifications as $notif)
                      <a href="{{url('/quotes/'.$notif->quote->slug)}}">{{$notif->subject .' di kutipan '. $notif->quote->title}}</a><br>
                    @endforeach
                  </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@php
  $notif_model::where('user_id', $user->id)->where('seen',0)->update(['seen'=>1]);
@endphp
@endsection
