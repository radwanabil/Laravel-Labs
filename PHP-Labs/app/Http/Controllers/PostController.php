<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostController extends Controller
{
    use SoftDeletes;
    public function index()
    {
      
 
        $allPosts = Post::paginate(10);
        Paginator::useBootstrap();
        return view('posts.index', ['posts' => $allPosts]);
    }

    public function show($post)
    {
     

        $post = Post::where('id', $post)->first(); //Post model object ... select * from posts where id = 1 limit 1;
        $users = User::all();


        return view('posts.show', ['post' => $post ,'users' => $users]);
    }
    
    public function create(){
        $users = User::all();

        return view('posts.create', ['users' => $users]);
    
    }
    public function edit($post){
        $post= Post::find($post);
        $users = User::all();
        return view('posts.edit', ['users' => $users], ['post' => $post]);
    }
    public function store(Request $request){
        Post::create([
            'title' => request()->title,
            'description' => request()->description,
            'user_id' => request()->creator,
        ]);
        return to_route('posts.index');
    
    }
    public function update($post){
        Post::where('id', $post)->update([
            'title' => request()->title,
            'description' => request()->description,
            'user_id' => request()->creator,
        ]);
       return to_route('posts.index');
    }
    public function destroy($post){
        $Foundpost = Post::find($post);
        $Foundpost->comments->destroy();
        Post::where('id', $Foundpost)->delete();
        return to_route('posts.index');
    }
    public function restore()
    {
        $posts = Post::onlyTrashed();
        $posts->restore();
              return to_route('posts.index');
        
    }
}