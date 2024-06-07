@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="rlg my-3">
        <div class="col-lg-8">
            <h1 class="mb-1 text-3xl tracking-tight font-bold text-gray-900">{{ $post['title'] }}</h1>
            <a href="/dashboard/posts" class="btn btn-success">Back to all my Post</a>
            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning">Edit</a>
            <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
            @if($post->image)
            <div style="max-height: 350px; overflow:hidden">
                <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->category->name }}" class="img-fluid mt-3">
            </div>
            @else
                <img src="https://source.unsplash.com/random/1200×400/?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid mt-3">
            @endif
            <article class="my-3 fs-5">
            {!! $post->body !!}
            </article>
        </div>
    </div>
</div>

@endsection

