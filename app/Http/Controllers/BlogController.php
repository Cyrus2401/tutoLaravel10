<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{

    public function index(){
        $posts = Post::paginate(5);
        return view('blog.index', ['posts' => $posts]);
    }

    public function show(string $slug, Post $post, Request $request) {
        
        if($post->slug != $slug){
            return to_route('blog.show', ["slug" => $post->slug, "post" => $post]);
        }

        return view('blog.show', ['post' => $post]);
    }

    public function create(){
        $post = new Post();

        return view("blog.create", ['post' => $post, 'categories' => Category::all(), 'tags' => Tag::all()]);
    }

    public function store(Request $request) {

        $request->validate([
            'title' => 'required|min:8',
            // 'slug' => 'required|min:8|regex:/^[0-9a-z\-]+$/',
            'content' => 'required',
            'category' => 'required|exists:categories,id',
            'tag' => 'array|exists:tags,id|required',
            'image' => 'image|max:2000'
        ]);

        $image = request('image');

        if($image != null){
            $imagePath = $image->store('blog', 'public');
        }else{
            $imagePath = "";
        }

        $post = Post::create([
            'title' => request('title'),
            'content' => request('content'),
            'slug' => \Str::slug(request('title')),
            'category_id' => request('category'),
            'tag' => request('tag'),
            'image' => $imagePath
        ]);

        $success_message = "L'article a été ajouté avec succes !";

        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success', $success_message);

    }

    public function edit(Post $post){
        return view('blog.edit', [
            'post' => $post,
            'categories' => Category::all(),
            'tags' => Tag::all()
        ]);
    }

    public function update(Request $request, Post $post) {

        $request->validate([
            'title' => 'required|min:8',
            // 'slug' => 'required|min:8|regex:/^[0-9a-z\-]+$/',
            'content' => 'required',
            'category' => 'required|exists:categories,id',
            'tag' => 'array|exists:tags,id|required'
        ]);
        
        $post->update([
            'title' => request('title'),
            'content' => request('content'),
            'slug' => \Str::slug(request('title')),
            'category_id' => request('category'),
            'tag' => request('tag')
        ]);

        $success_message = "L'article a été modifé avec succes !";

        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success', $success_message);

    }

}
