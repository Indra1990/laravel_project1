@extends('layouts.app')

@section('content')
<script type="text/javascript">
    tinymce.init({
        selector : '#tinytextarea',
        menubar  : false,
        plugins  :'codesample , jbimages, image',
        toolbar  :'codesample, italic, bold, jbimages ,image'
    });    
</script>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                <h3>Edit Quotes</h3> 
                @if(count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if(session('tag_error'))
                    <div class="alert alert-danger">
                        {{ session('tag_error') }}
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
                        <textarea class="form-control" name="subject" rows="8" cols="80" id="tinytextarea">{{ (old('subject')) ? old('subject') : $quote->subject }}
                        </textarea>
                    </div>
                    
                       {{-- tags --}}
                    <div id="tag_wrapper" class="form-group">
                        <label for=""> Tag Maximal 3</label>
                        <div id="add_tag"> Add Tag </div>
                        @foreach ($quote->tags as $oldtag) 
                            <select id="tag_select" name="tags[]">
                                <option value="0">Tidak Ada</option>
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}" 
                                        @if ($oldtag->id == $tag->id)
                                        selected="selected"
                                        @endif
                                        >{{ $tag->tag_name }}</option>
                                @endforeach
                            </select>
                        @endforeach

                        <script type="text/javascript" src="{{ asset('js/tag.js') }}"></script>
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
@endsection
