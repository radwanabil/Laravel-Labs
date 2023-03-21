<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Symfony\Component\HttpKernel\HttpCache\StoreInterface;

class PostController extends Controller
{
    // use SoftDeletes;
    
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
    public function store(StorePostRequest $request){

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->creator,
        ]);
        return to_route('posts.index');
    
    }
    public function update(StorePostRequest $request,$post){
        Post::where('id', $post)->update([
            'title' => request()->title,
            'description' => request()->description,
            'user_id' => request()->creator,
        ]);
       return to_route('posts.index');
    }
    public function destroy($post){
        $Foundpost = Post::findOrFail($post);
        $Foundpost->Comments()->delete();
        $Foundpost->delete();
        return to_route('posts.index');
    }
    public function restore()
    {
        $posts = Post::onlyTrashed();
        $posts->restore();
              return to_route('posts.index');
        
    }
}