@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Lista Wpisów</h2>
        <a href="{{ route('home') }}" class="btn btn-secondary">Powrót do Strony Głównej</a>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Dodaj Wpis lub tagi</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Tytuł</th>
                    <th>Data Publikacji</th>
                    <th>Tagi</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->publication_date }}</td>
                        <td>
                            @foreach ($post->tags as $tag)
                                <span class="badge badge-primary" style="color: black;">{{ $tag->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info">Pokaż</a>
                            <a href="{{ route('posts.edit', ['id' => $post->id]) }}" class="btn btn-warning">Edytuj</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć ten wpis?')">Usuń</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $posts->links() }} <!-- Wyświetlanie linków paginacji -->
    </div>
@endsection
