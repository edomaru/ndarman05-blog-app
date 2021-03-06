<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Post;
use App\Model\Category;

class BlogController extends Controller
{
    protected $limit = 3;

    public function index(){
    
        $posts = Post::with('author')
                            ->latestFirst()
                            ->published()
                            ->paginate($this->limit);
        return view('blog.index', compact('posts'));
    }

    public function category(Category $category){
        

        $categoryName = $category->title;

        $posts = $category->posts()
                            ->with('author')
                            ->latestFirst()
                            ->published()
                            ->paginate($this->limit);

        return view('blog.index', compact('posts', 'categoryName'));
    }

    public function show(Post $post){
        return view('blog.show', compact('post'));
    }
}
