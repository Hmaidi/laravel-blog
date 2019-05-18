@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                     <a href="http://localhost/blog/public/posts/create" class="btn btn-primary">
                        Create Post
                    </a><br>
                    <h2>You are logged in!</h2>
                    <table class="table table-striped">
                        <tr>
                            <th>Titre</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{$post->Title}}</td>
                                <td>
                                        <a  href="http://localhost/blog/public/posts/{{$post->id}}/edit">
                                        <button type="button" class="btn btn-sm btn-primary">
                                   
                                        Edit
                                        </button>
                                        </a>
                                </td>
                                <td>
                                        {!! Form::open(['action' => ['PostsController@destroy',$post->id], 'method' => 'POST']) !!}
                                           {{Form::hidden('_method','DELETE')}}
                                           {{Form::submit('Delete',['class'=>'btn btn-sm btn-danger'])}} 
                                         {!! Form::close(); !!}
                                 </td>
                            </tr>
                        @endforeach
                     
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
