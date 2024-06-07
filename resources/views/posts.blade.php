<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    
    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form action="/posts">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif
                <div class="input-group mb-3 ">
                    <input type="text" class="form-control" placeholder="Search.." name='search' value="{{ request('search') }}">
                    <button class="btn btn-danger" type="submit" >Search</button>
                </div>
            </form>
        </div>
    </div>

    @if ($posts->count())
        <div class="card mb-3">
            @if($posts[0]->image)
            <div style="max-height: 350px; overflow:hidden">
                <img src="{{ asset('storage/'.$posts[0]->image) }}" alt="{{ $posts[0]->category->name }}" class="img-fluid mt-3">
            </div>
            @else
                <img src="https://source.unsplash.com/random/1200×400/?{{ $posts[0]->category->name }}" alt="{{ $posts[0]->category->name }}" class="img-fluid  ">
            @endif
            <div class="card-body text-center">
                <h3 class="card-title"><a href="/posts/{{ $posts[0]['slug'] }}" 
                    class=" text-decoration-none text-dark"> {{ $posts[0]->title}} </a></h3>
                <div>
                    By
                    <a href="/posts?author={{ $posts[0]->author->username }}" class="hover:underline text-base text-gray-500">{{ $posts[0]->author->name }} </a>  
                    in
                    <a href="/posts?category={{ $posts[0]->category->slug }}" class="hover:underline text-base text-gray-500">{{ $posts[0]->category->name }}</a>
                    | {{ $posts[0]->created_at -> diffForHumans() }}
                </div>
                <p class="card-text">{{ Str::limit(strip_tags($posts[0]['body']), 125) }}</p>
                <a href="/posts/{{ $posts[0]['slug'] }}" class="text-decoration-none  btn btn-primary">Read More &raquo;</a>
            </div>
        </div>
    
    <div class="container">

        
        <div class="row">
            @foreach ( $posts->skip(1) as $post )
            <div class="col-md-4">
                <div class="card">
                    <a href="/posts?category={{ $post->category->slug }}" class=" text-decoration-none position-absolute  px-3 py-2 text-white" style="background-color:rgba(0,0,0,0.7)">{{ $post->category->name }}</a>
                    @if($post->image)
                        <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->category->name }}" class="img-fluid">
                    @else
                        <img src="https://source.unsplash.com/random/500×400/?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid mt-3">
                    @endif
                    <div class="card-body">
                      <h5 class="card-title">{{ $post['title'] }}</h5>
                      <div>
                        By
                        <a href="/posts?author={{ $post->author->username }}" class="hover:underline text-base text-gray-500">{{ $post->author->name }} </a>  
                        | {{ $post->created_at -> diffForHumans() }}
                    </div>
                      <p class="card-text">{{ Str::limit(strip_tags($post['body']), 125) }}</p>
                      <a href="/posts/{{ $post['slug'] }}" class="btn btn-primary">Read More</a>
                    </div>
                  </div>
            </div>
            @endforeach
        </div>
    </div>

    @else
        <p class="text-center fs-4">No Post Found.</p>
    @endif

    <div class="d-flex justify-center">
        {{ $posts->links() }}
    </div>
</x-layout>