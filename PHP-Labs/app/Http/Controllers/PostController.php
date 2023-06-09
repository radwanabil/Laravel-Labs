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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Jobs\PruneOldPostsJob;
use App\Rules\MaxPosts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
PruneOldPostsJob::dispatch();

class PostController extends Controller
{
   use SoftDeletes;

    
    public function index()
    {
        
        
        $allPosts = Post::withTrashed()->with('user')->paginate(5);

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
        $userId = $request->creator;
        // $validator = Validator::make(['user_id' => $userId], [
        //     'user_id' => [new MaxPosts($userId)],
        // ]);
    
        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }
   
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/image', $image->getClientOriginalName());
            $imageName = $image->getClientOriginalName();
        }
        
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' =>  $userId,
            'image'=> isset($imagePath) ? $imageName : null,
    
        ]);
        return to_route('posts.index');
    
    }
    public function update(StorePostRequest $request,$post){
        if ($request->hasFile('image')) {
            
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/image', $image->getClientOriginalName());
            $imageName = $image->getClientOriginalName();
        }
        Post::where('id', $post)->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->creator,
            'image'=> isset($imagePath) ? $imageName : null,
        ]);
       return to_route('posts.index');
    }
    public function destroy($post){

        
        $Foundpost = Post::findOrFail($post);
             
        if ($Foundpost->image) {
       
           $imagePath = 'public/image/' . $Foundpost->image; 
            Storage::delete($imagePath);
        }
        $Foundpost->Comments()->delete();
        $Foundpost->delete();
        return to_route('posts.index');
    }
    public function restore($post)
    {
        $post = Post::withTrashed()->find($post);
        $post->restore();
        return to_route('posts.index');
        
    }
    public function githubRedirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function githubCallBack()
    {
        $userData = Socialite::driver('github')->stateless()->user();
        $user = User::where('email', $userData->email)->first();
        if ($user) {
            Auth::login($user);
            return to_route('posts.index');
            }
            $user = new User();
            $user->name = $userData->name;
            $user->email = $userData->email;
            $user->password = Hash::make(Str::random(24));
            $user->save();
            Auth::login($user);
            return to_route('posts.index');
        
    }
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallBack()
    {
        $userData = Socialite::driver('google')->stateless()->user();
        $user = User::where('email', $userData->email)->first();
        if ($user) {
            Auth::login($user);
            return to_route('posts.index');
            }
            $user = new User();
            $user->name = $userData->name;
            $user->email = $userData->email;
            $user->password = Hash::make(Str::random(24));
            $user->save();
            Auth::login($user);
            return to_route('posts.index');
        
    }
}