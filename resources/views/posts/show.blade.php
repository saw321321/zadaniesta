@extends('layouts.app')

@section('content')
    <h1>Widok postu</h1>

  <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{ $post->title }}</h2>
            
            <p class="card-text">{{ $post->content }}</p>
            <p class="card-text">Data publikacji: {{ $post->publication_date }}</p>
            <div class="tags">
                @foreach ($post->tags as $tag)
                    <span class="badge badge-primary" style="color: black;">Tagi: {{ $tag->name }}</span>
                @endforeach
            </div>
        </div>
    </div>

    

    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Powrót do listy</a>
@endsection