@extends('layouts.app')


@section('title') Index @endsection

@section('content')

<script src="{{ asset('js/jquery.min.js') }}"></script>
<!-- Bootstrap JavaScript -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<div class="text-center">
    <a href="{{route('posts.create')}}" class="mt-4 btn btn-success">Create Post</a>
    <a href="{{route('posts.restore')}}"></a>
</div>
<table class="table mt-4">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col">Image</th>
            <th scope=" col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>

        </tr>
    </thead>
    <tbody>

        @foreach($posts as $post)

        <tr>
            <td>{{$post->id}}</td>
            <td>{{$post->title}}</td>
            <td>{{$post->slug}}</td>
            <td>{{$post->image}}</td>
            @if($post->user)
            <td>{{$post->user->name}}</td>
            @else
            <td>Not Found</td>
            @endif
            <td>{{ $post->created_at->toDateString(); }}</td>
            <td>

                <x-button type="info" :href="route('posts.show', $post->id)">
                    view
                </x-button>
                <x-button type="primary" :href="route('posts.edit',$post->id)">edit</x-button>

                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#exampleModal{{$post->id}}">Delete</button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{$post->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Warning!!</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this post?

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form style="display: inline" method="POST"
                                    action="{{ route('posts.destroy', $post->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-primary"
                                        onclick="document.getElementById('delete-form').submit();">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{$posts->links()}}
@endsection