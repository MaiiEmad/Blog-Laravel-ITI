<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{

//home
    public function index()
    {
        $posts = Post::paginate(10);
        if (count($posts) <= 0) {
            return view('posts.empty');
        }
        return view('posts.index', ['posts' => $posts]);
    }


    public function empty()
    {
        return view('posts.empty');
    }
    public function create()
    {
        $user = User::all();
        return view('posts.create', ['user' => $user]);
    }

    public function store()
    {
        $requestData = request()->all();
               
        Post::create($requestData);
        return to_route('posts.index');
    }
    public function show($postID)
    {
        $posts = Post::find($postID);
        return view('posts.show', ['posts' => $posts]);
    }
    public function edit($postID)
    {
        $posts = Post::find($postID);
        return view('posts.edit', ['posts' => $posts, 'postID' => $postID]);
    }

    public function update($postID)
    {
        $fetchData = request()->all();
        $flight = Post::find($postID);
        $flight->title = $fetchData['title'];
        $flight->description = $fetchData['description'];
        $flight->save();
        return to_route('posts.index');
    }

    public function destroy($postID)
    {
        Post::find($postID)->delete();
        return to_route('posts.index');
    }

    public function showDeleted()
    {
        $posts = Post::onlyTrashed()->get();
        if (count($posts) <= 0) {
            return view('posts.emptyDelete');
        }
        return view('posts.showDeleted', ['posts' => $posts]);
    }
    public function restore($postID)
    {
        Post::withTrashed()->find($postID)->restore();
        return to_route('posts.showDeleted');
    }

}
