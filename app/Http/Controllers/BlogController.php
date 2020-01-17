<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Post;

class BlogController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view('blog.index', compact('posts'));
    }

    public function show(){
        return view('blog.show');
    }
}
