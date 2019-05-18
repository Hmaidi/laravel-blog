@extends('layouts.app')

@section('content')
<h1>Update Post</h1>
{!! Form::open(['action' => ['PostsController@update',$post->id], 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('Title', 'Title') }}
        {{Form::Text('Title',$post->Title,['class'=>'form-control','placeholder'=>'Title'])}} 
    </div>
    <div class="form-group">
            {{Form::label('Body', 'Body') }}
            {{Form::Textarea('Body',$post->Body,['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Body Text'])}} 
        </div>
        <div class="form-group">
            {!! Form::label('Cover Image') !!}
            {!! Form::file('cover_image') !!}
          </div>
        {{Form::hidden('_method','PUT')}}
      {{Form::submit('Save',['class'=>'btn btn-primary'])}}  
{!! Form::close() !!}
@endsection
