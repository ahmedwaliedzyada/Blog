<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $posts = Post::orderBy('created_at' ,'DESC')->paginate(10);
        return view('posts.post',compact('posts'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);
        if (request('cover_image')){

        $imagePath = request('cover_image')->store('uploads' , 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))
            ->fit(1200,1200);
        $image->save();

        }else{
            $imagePath = 'noimage.png';
        }

        $post = auth()->user()->posts()->create([
            'title' => $request['title'],
            'body' => $request['body'],
            'cover_image' => $imagePath
        ]);
        flash('Post Created')->success();
        return redirect('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if (auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','Unauthorized Page');
        }
        return view('posts.edit',compact('post'));
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
        $request = request()->validate([
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        if (request('cover_image')){

            $imagePath = request('cover_image')->store('uploads' , 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))
                ->fit(1200,1200);

            $image->save();

            $imageArray = ['cover_image' => $imagePath];
        }
        $post = Post::findOrFail($id);
        $post->update(array_merge(
            $request,
            $imageArray ?? []
        ));
        flash('Post Updated')->success();
        return redirect('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if (auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','Unauthorized Page');
        }
        if ($post->cover_image != 'noimage.jpg'){
            Storage::delete("storage/uploads/".$post->cover_image);
        }
        $post->delete();
        flash('Post Deleted')->error();
        return redirect('posts');
    }
}

