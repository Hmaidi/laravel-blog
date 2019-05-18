@extends('layouts.app')

@section('content')
<h1>Create Post</h1>
{!! Form::open(['action' => 'PostsController@store', 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('Title', 'Title') }}
        {{Form::Text('Title','',['class'=>'form-control','placeholder'=>'Title'])}} 
    </div>
    <div class="form-group">
            {{Form::label('Body', 'Body') }}
            {{Form::Textarea('Body','',['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Body Text'])}} 
    </div>
    <div class="form-group">
      {!! Form::label('Cover Image') !!}
      {!! Form::file('cover_image') !!}
    </div>
      {{Form::submit('submit',['class'=>'btn btn-primary'])}}  
{!! Form::close() !!}
@endsection