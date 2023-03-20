@extends('layouts.app')

@section('title') Show @endsection
@section('content')
<form method="POST" action="{{route('posts.update',$post->id)}}">
    @csrf
    @method('put')
    <!-- <div class="mb-3 mt-3" style="display:none;">
        <label for="exampleFormControlInput1" class="form-label">ID</label>
        <input type="text" name="id" class="form-control w-50" id="exampleFormControlInput1" placeholder=""
            value="{{$post->id}}">
    </div> -->
    <div class="mb-3 mt-3">
        <label for="exampleFormControlInput1" class="form-label">Title</label>
        <input type="text" name="title" class="form-control w-50" id="exampleFormControlInput1" placeholder=""
            value="{{$post['title']}}">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
        <textarea class="form-control w-50" name="description" id="exampleFormControlTextarea1"
            rows="3">{{$post['description']}}</textarea>
    </div>

    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Post Creator</label>
        <select name="creator" class="form-control w-50">
            <option value="{{$post->user->id}}">{{$post->user->name}}</option>


        </select>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection