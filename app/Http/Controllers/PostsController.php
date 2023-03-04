<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use SebastianBergmann\Complexity\Calculator;

class PostsController extends Controller
{
    public function index() {

        $posts = Post::all();
        return view('post.index', compact('posts'));
    }

    public function create() {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.create', compact('categories', 'tags'));
    }

    public function store(){
        $data = request()->validate([
            'title' => 'required | string',
            'content' => 'string',
            'img' => 'string',
            'category_id' => 'string',
            'tags' => ''
        ]);
        $tags = $data['tags'];
        unset($data['tags']);

        $post = Post::create($data);
        $post->tags()->attach($tags);

        return redirect()->route('posts.index');
    }

    public function show(Post $post){
        return view('post.show', compact('post'));
    }

    public function edit(Post $post){
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Post $post) {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'img' => 'string',
            'category_id' => 'string',
            'tags' => ''
        ]);
        $tags = $data['tags'];
        unset($data['tags']);

        $post->update($data);
        $post->tags()->sync($tags);
        return redirect()->route('post.show', $post->id);

    }

    public function destroy(Post $post){
        $post->delete();
        return redirect()->route('posts.index');
    }

    public function delete() {
        $post = Post::find(2);
        $post->delete();
        dd('delete');
    }

    public function restore() {
        $post = Post::withTrashed()->find(2);
        $post->restore();
        dd('restore');
    }

    //firstOrCreate
    //updateOrCreate

    public function firstOrCreate() {
        $anotherPost =[
            'title' => 'title of post from phpstorm',
            'content' => 'some content',
            'img' => 'test.jpg',
            'likes' => 3222,
            'is_published' => 1,
        ];

        $post = Post::firstOrCreate([
            'title' => '3 title of post from phpstorm'
        ],[
            'title' => '3 title of post from phpstorm',
            'content' => '3 some content',
            'img' => 'test.jpg',
            'likes' => 3222,
            'is_published' => 1,
        ]);
        dump($post->content);
        dd('firstOrCreate');
    }

    public function updateOrCreate() {
        $anotherPost =[
            'title' => 'updateOrCreate',
            'content' => 'updateOrCreate content',
            'img' => 'updateOrCreate.jpg',
            'likes' => 2,
            'is_published' => 1,
        ];

        $post = Post::updateOrCreate([
            'title' => '4title of post from phpstorm'
        ],[
            'title' => 'updateOrCreate',
            'content' => 'updateOrCreate content',
            'img' => 'updateOrCreate.jpg',
            'likes' => 2,
            'is_published' => 1,
        ]);
        dump($post->content);
        dd('updateOrCreate');
    }
}
