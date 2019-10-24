<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::with('user')->where('user_id' , auth()->user()->id)->paginate(10);
        return view('home',compact('posts'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function services()
    {
        return view('pages.services');
    }

    public function main()
    {
        return view('pages.index');
    }

}

