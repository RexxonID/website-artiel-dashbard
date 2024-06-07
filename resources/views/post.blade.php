<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>


    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <h1 class="mb-1 text-3xl tracking-tight font-bold text-gray-900">{{ $post['title'] }}</h1>
                <div>
                    By
                    <a href="/posts?author={{ $post->author->username }}" class="hover:underline text-base text-gray-500">{{ $post->author->name }} </a>  
                    in
                    <a href="/posts?category={{ $post->category->slug }}" class="hover:underline text-base text-gray-500">{{ $post->category->name }}</a>
                    | {{ $post->created_at -> diffForHumans() }}    
                </div>
                @if($post->image)
                <div style="max-height: 350px; overflow:hidden">
                    <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->category->name }}" class="img-fluid mt-3">
                </div>
                @else
                    <img src="https://source.unsplash.com/random/1200×400/?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid ">
                @endif
                <article class="my-3 fs-5">
                {!! $post->body !!}
                </article>
                <a href="/posts" class="font-medium text-blue-500 hover:underline">&laquo;Back to posts</a>
            </div>
        </div>
    </div>
</x-layout>