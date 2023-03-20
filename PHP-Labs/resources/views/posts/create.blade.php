@extends('layouts.app')

@section('title') Show @endsection
@section('content')

<form method="POST" action="{{route('posts.store')}}">
    @csrf

    <div class="mb-3 mt-3">
        <label for="exampleFormControlInput1" class="form-label">Title</label>
        <input type="text" name="title" class="form-control w-50" id="exampleFormControlInput1" placeholder="">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
        <textarea class="form-control w-50" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>

    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Post Creator</label>
        <select name="creator" class="form-control w-50">
            @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>

            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Create</button>
</form>
@endsection