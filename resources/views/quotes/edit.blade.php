@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Quotes</div>
                @if(count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="/quotes/{{ $quote->id }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Judul</label>
                        <input type="text" class="form-control" name="title" value="{{ (old('title')) ? old('title') : $quote->title }}" placeholder="tulis judul disini">
                    </div>

                     <div class="form-group">
                        <label for="subject">Isi Kutipan</label>
                        <textarea class="form-control" name="subject" rows="8" cols="80">{{ (old('subject')) ? old('subject') : $quote->subject }}</textarea>
                    </div>

                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-block" value="Submit">
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
