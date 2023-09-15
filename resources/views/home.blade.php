@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Panel Główny</h1>

    
      
            <li>
                <a href="{{ route('users.index') }}" class="btn btn-primary">
                    Wyszukaj Użytkowników
                </a>
            </li>
            <li>
                <a href="{{ route('posts.index') }}" class="btn btn-primary">
                   Zarządzaj Wpisami
                </a>
      
    
</div>
@endsection
