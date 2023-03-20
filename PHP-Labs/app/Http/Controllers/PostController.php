<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class PostController extends Controller
{
    public function index()
    {
      
 
        $allPosts = Post::paginate(10);
        Paginator::useBootstrap();
        return view('posts.index', ['posts' => $allPosts]);
    }

    public function show($id)
    {
     

        $post = Post::where('id', $id)->first(); //Post model object ... select * from posts where id = 1 limit 1;
        $users = User::all();


        return view('posts.show', ['post' => $post ,'users' => $users]);
    }
    
    public function create(){
        $users = User::all();

        return view('posts.create', ['users' => $users]);
    
    }
    public function edit($id){
        $post= Post::find($id);
        $users = User::all();
        return view('posts.edit', ['users' => $users], ['post' => $post]);
    }
    public function store(Request $request){
        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->creator;
        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
        ]);
        return to_route('posts.index');
    
    }
    public function update($id){
        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->creator;
        Post::where('id', $id)->update([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
        ]);
       return to_route('posts.index');
    }
    public function delete($id){
        Post::where('id', $id)->delete();
        return to_route('posts.index');
    }
}