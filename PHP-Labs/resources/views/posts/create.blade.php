@extends('layouts.app')

@section('title') Show @endsection
@section('content')

<form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3 mt-3">
        <label for="exampleFormControlInput1" class="form-label">Title</label>
        <input type="text" name="title" class="form-control w-50" id="exampleFormControlInput1" placeholder="">
        @if($errors->has('title'))

        <div class="alert alert-danger error w-50 h-25 mt-2">{{ $errors->first('title') }}</div>
        @endif


    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
        <textarea class="form-control w-50" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
        @if($errors->has('description'))

        <div class="alert alert-danger error w-50 h-25 mt-2">{{ $errors->first('description') }}</div>
        @endif
    </div>

    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Post Creator</label>
        <select name="creator" class="form-control w-50">
            @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>

            @endforeach
        </select>
    </div>
    <label class="form-check-label">Post Image</label>
    <input class="form-control w-50" type="file" id="formFile" name="image">
    @if($errors->has('image'))
    <div class="alert alert-danger error w-50 h-25 mt-2">This type is not supported</div>
    @endif
    <br>
    <button type="submit" class="btn btn-success">Create</button>
    @error('user_id')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</form>

@endsection