<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index()
    {
         $allPosts = Post::all();  
        return PostResource::collection($allPosts);
    }
    
    public function show($id){
        $post = Post::find($id);
        return new PostResource($post);
        
    }
    
    public function store(StorePostRequest $request){
        $title = request()->title;
        $description = request()->description;
        $user = request()->creator;
        $post = Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $user,
        ]);
        return new PostResource($post);
        
    }
     
}