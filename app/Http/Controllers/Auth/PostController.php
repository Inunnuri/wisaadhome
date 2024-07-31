<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class PostController extends Controller
{
    // Menampilkan semua artikel
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts', ['title' => 'Articles', 'posts' => $posts]);
    }

    // Menampilkan detail artikel dan artikel terkait dari kategori yang sama
    public function show(Post $post)
    {
        $title = 'Article';
        $relatedPosts = Post::where('category_id', $post->category_id)
                            ->where('id', '!=', $post->id)
                            ->take(5)
                            ->get();
        
        return view('post', compact('title','post', 'relatedPosts'));
    }
    
    public function author(User $user){
        $title = count($user->posts) . ' Articles by '. $user->name;
        $posts = Post::where('author_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('posts', compact('title', 'posts'));
    }

    public function category(Category $category){
        $title = 'Articles in '. $category->name;
        $posts = Post::where('category_id', $category->id)->orderBy('created_at', 'desc')->get();
        return view('posts', compact('title', 'posts'));
    }
}

// done
