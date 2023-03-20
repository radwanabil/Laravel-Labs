@extends('layouts.app')


@section('title') Index @endsection

@section('content')
<div class="text-center">
    <a href="{{route('posts.create')}}" class="mt-4 btn btn-success">Create Post</a>
    <a href="{{route('posts.restore')}}"></a>
</div>
<table class="table mt-4">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>

        @foreach($posts as $post)

        <tr>
            <td>{{$post->id}}</td>
            <td>{{$post->title}}</td>
            @if($post->user)
            <td>{{$post->user->name}}</td>
            @else
            <td>Not Found</td>
            @endif
            <td>{{ \Carbon\Carbon::parse( $post->created_at )->toDateString(); }}</td>
            <td>

                <x-button type="info" :href="route('posts.show', $post->id)">
                    view
                </x-button>
                <x-button type="primary" :href="route('posts.edit',$post->id)">edit</x-button>
                <form style="display: inline" method="POST" action="{{ route('posts.delete', [$post['id']]) }}">
                    @method('DELETE')
                    @csrf
                    <button onclick="return confirm('Are you sure you want to delete this post?');"
                        class="btn btn-danger">Delete</button>
                </form>


            </td>
        </tr>
        @endforeach



    </tbody>
</table>
{{$posts->links()}}
@endsection