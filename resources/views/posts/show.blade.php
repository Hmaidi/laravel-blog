@extends('layouts.app')

@section('content')
<h1 class="col-sm-12">{{$post->Title}}</h1>
 
      <div class="well col-sm-12">
                    <div class="card mb-12 shadow-sm">
                      
                      <div class="card-body">
                          <div class="col-xs-12">
                              <img style="width:100%" src="http://localhost/blog/public/storage/cover_images/{{$post->cover_image}}">
                               <br><br>
                            </div>
                        <p class="card-text">{!!$post->Body!!}</p>
                        <div class="d-flex justify-content-between align-items-center">
                    
                          <small class="text-muted">{{$post->created_at}} By 
                              {{$post->user->name}} </small>
                        </div>
                      </div>
                    </div>
                 
      </div>  

    
@endsection