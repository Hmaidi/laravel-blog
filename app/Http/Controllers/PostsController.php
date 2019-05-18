<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

       /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','posts','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
                'Title'=>'required',
                'Body'=>'required',
                'cover_image'=>''
        ]);
         if ($request->hasFile('cover_image')) {
             $fileNameWithExtensions=$request->file('cover_image')->getClientOriginalName();
             $filename=pathinfo($fileNameWithExtensions,PATHINFO_FILENAME);
             $extension=$request->file('cover_image')->getClientOriginalExtension();

             $fileNameToStore=$filename.'_'.time().'.'.$extension;
             //Uploade Images
             $path=$request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
         }
         else{
             $fileNameToStore='noimage.jpg';
         }
        $post = new Post();
        $post->Title = $request->input('Title');
        $post->Body = $request->input('Body');
        $post->user_id= auth()->user()->id;
        $post->cover_image=$fileNameToStore;
        $post->save();
        return redirect('/posts')->with('success','The Post Create with sccess');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post =Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post =Post::find($id);
        /*if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error','Unauthorized page');
        }*/
        return view('posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    
        $this->validate($request,[
            'Title'=>'required',
            'Body'=>'required',
             'cover_image'=>''
             
    ]);
    if ($request->hasFile('cover_image')) {
        $fileNameWithExtensions=$request->file('cover_image')->getClientOriginalName();
        $filename=pathinfo($fileNameWithExtensions,PATHINFO_FILENAME);
        $extension=$request->file('cover_image')->getClientOriginalExtension();

        $fileNameToStore=$filename.'_'.time().'.'.$extension;
        //Uploade Images
        $path=$request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
    }
   
    $post =Post::find($id);
    $post->Title = $request->input('Title');
    $post->Body = $request->input('Body');
    if($request->hasFile('cover_image')){

        $post->cover_image=$fileNameToStore;
    }
 
    $post->save();
    return redirect('/posts')->with('success','The Post Updated with sccess');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post =Post::find($id);
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error','Unauthorized page');
        }
        if($post->cover_image !="noimage.jpg"){
         Storage::delete('public/cover_images/'.$post->cover_image);
        }
        $post->delete();
        return redirect('/posts')->with('success','The Post deleted with sccess');
    }
}
