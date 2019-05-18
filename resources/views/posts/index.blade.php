@extends('layouts.app')

@section('content')
<h1 class="col-sm-12">Posts</h1>
@if (count($posts)>0)
@foreach ($posts as $post)
      <div class="well col-sm-12">
                    <div class="card mb-4 shadow-sm">
                      
                      <div class="card-body">
                        <div class="col-sm-6 col-md-4 float-left">
                        <img style="width:100%" src="http://localhost/blog/public/storage/cover_images/{{$post->cover_image}}">
                         <br><br>
                      </div>
                        <div class="col-sm-6 col-md-8 float-right">
                      <p class="card-title">{{$post->Title}}</p>
                        <p class="card-text">{!!$post->Body!!}</p>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                              <a href="http://localhost/blog/public/posts/{{$post->id}}">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                View
                                </button>
                              </a>
                         @if (!Auth::guest())
                                  
                            @if (Auth::user()->id == $post->user_id)
          
                                    <a href="http://localhost/blog/public/posts/{{$post->id}}/edit" style="margin:0px 5px;">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">
                                      Edit
                                    </button>
                                  </a>

                                {!! Form::open(['action' => ['PostsController@destroy',$post->id], 'method' => 'POST']) !!}
                                    {{Form::hidden('_method','DELETE')}}
                                    {{Form::submit('Delete',['class'=>'btn btn-sm btn-outline-secondary'])}} 
                                  {!! Form::close(); !!}

                             @endif
                          @endif
                          </div>
                          <small class="text-muted">
                            {{$post->created_at}} By 
                            <strong>
                            {{$post->user->name}}</strong>
                          </small>
                        </div>
                      </div>
                    </div>
                  </div>
      </div>  
@endforeach
 
@else 
  <p> No Posts  Found</p>
@endif
    
@endsection