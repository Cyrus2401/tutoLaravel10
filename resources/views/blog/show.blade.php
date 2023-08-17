@extends('base')

@section('title', $post->title)

@section('content')
    
    <article>

        <h2>{{ $post->title }}</h2>
        <p>{{ $post->content }}</p>

        @can('seeImage', $post)
            @if($post->image)
                <img src="/storage/{{ $post->image }}" alt="image" style="width: 100%; height: 200px; object-fit:cover;">
            @endif
        @endcan

    </article>

@endsection