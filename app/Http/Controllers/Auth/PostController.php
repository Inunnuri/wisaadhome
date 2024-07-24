<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

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
        $title = 'Article'; // Asumsi `username` adalah kolom di model `User`
        $relatedPosts = Post::where('category_id', $post->category_id)
                            ->where('id', '!=', $post->id)
                            ->take(5)
                            ->get();
        
        return view('post', compact('title','post', 'relatedPosts'));
    }
    
}
