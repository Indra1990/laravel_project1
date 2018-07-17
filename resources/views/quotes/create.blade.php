@extends('layouts.app')

@section('content')




<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                <h3>Create Quotes</h3>
                <hr>
                {{-- error validation title and subject --}}
                @if(count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                {{-- tag error --}}
                @if(session('tag_error'))
                    <div class="alert alert-danger">
                        {{ session('tag_error') }}
                    </div>    
                @endif
                {{-- posting quote --}}
                <form action="/quotes" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Judul</label>
                        <input type="text" class="form-control" name="title" value="{{old('title')}}" placeholder="tulis judul disini">
                    </div>

                     <div class="form-group">
                        <label for="subject">Isi Kutipan</label>
                        <textarea name="subject"  class="form-control" rows="8" cols="80" id="tinytextarea">{{old('subject')}}</textarea>
                    </div>
                    {{-- tags --}}
                    <div id="tag_wrapper" class="form-group">
                        <label for=""> Tag Maximal 3</label>
                        <div id="add_tag"> Add Tag </div>
                        <select id="tag_select" name="tags[]">
                            <option value="0">Tidak Ada</option>
                            @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                            @endforeach
                        </select>
                        <script type="text/javascript" src="{{ asset('js/tag.js') }}"></script>
                    </div>

                    <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-block" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
 --}}{{--      <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
 --}}{{-- <script type="text/javascript" src="{{ asset('js/summernote.js') }}"></script>
 --}}
 <script type="text/javascript">
    tinymce.init({
        selector : '#tinytextarea',
        menubar  : false,
        plugins  :'codesample , jbimages, image',
        toolbar  :'codesample, italic, bold, jbimages ,image'
    });    
</script>
 @endsection
