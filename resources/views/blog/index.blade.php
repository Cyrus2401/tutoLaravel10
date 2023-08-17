@extends('base')

@section('title', 'Accueil du blog')

@section('content')
    
    <h1 class="mt-2">Mon Blog</h1>
    
    @foreach ($posts as $post)
    
        <article>
            
            <h2>{{ $post->title }}</h2>

            <p class="small">
                @if($post->category)
                    Catégorie : {{ $post->category?->name }}
                @endif
                @if(!$post->tags->isEmpty())
                   @foreach($post->tags as $tag)
                       <span class="badge bg-secondary">{{ $tag->name }}</span>
                   @endforeach
                @endif
            </p>

            @if($post->image)
                <img src="/storage/{{ $post->image }}" alt="image" style="width: 100%; height: 200px; object-fit:cover;">
            @endif

            <p>{{ $post->content }}</p>

            <p>
                <a href="{{ route('blog.show', ["slug"=>$post->slug, "post"=>$post->id]) }}" class="btn btn-primary">Lire la suite</a>
            </p>

            <p>
                <a href="{{ route('blog.edit', ["post"=>$post->id]) }}" class="btn btn-primary">Modifier</a>
            </p>

        </article>

        <hr>

    @endforeach

    {{ $posts->links() }}

@endsection