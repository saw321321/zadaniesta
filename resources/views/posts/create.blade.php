@extends('layouts.app')

@section('content')


    <div id="app">

        <div v-if="PostForm">
            <post-form :tags="{{ $tags }}"></post-form>
        </div>
        <form method="POST" action="{{ route('tags.store') }}">
    @csrf
    <div class="form-group">
    <h1>Dodaj Tag</h1>
        <label for="tag_name">Nazwa Tagu:</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Dodaj Tag</button>
</form>
    </div>

    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Powrót do listy</a>
@endsection
