@extends('layouts.app')

@section('content')
<div id="app" v-app="UserList">
   

    <!-- Navigational Tabs -->

    <!-- Tab Content -->
    <div class="tab-content" id="adminTabsContent">
        <!-- Użytkownicy -->
        <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">
            <h2>Lista Użytkowników</h2>
            <a href="{{ route('home') }}" class="btn btn-secondary">Powrót do Strony Głównej</a>
            <a href="{{ route('users.create') }}" class="btn btn-primary">Dodaj Użytkownika</a>

            <!-- Dodaj odnośnik do strony głównej -->

            <table class="table">
                <thead>
                    <tr>
                        <th>Imię</th>
                        <th>Email</th>
                        <th>Rola</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edytuj</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć tego użytkownika?')">Usuń</button>
</form>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Dodaj suwak paginacji -->
            <div class="d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        </div>

    </div>
</div>
@endsection
