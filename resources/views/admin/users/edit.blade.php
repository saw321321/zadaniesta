@extends('layouts.app')

@section('content')
    <h1>Panel Administracyjny</h1>

    <div id="confirmation-modal" class="modal" style="display: none;">
          <div class="modal-content">
    <p>Czy na pewno chcesz zapisać użytkownika?</p>
    <button id="confirm-button" class="btn btn-primary">Tak</button>
    <button id="cancel-button" class="btn btn-secondary">Anuluj</button>
  </div>
    </div>

     <h2>Edytuj Użytkownika</h2>
    <div id="app" data-user-id="{{ $id }}">
        <div v-if="UserEdit">
            <!-- Przekaż Id jako data atrybut w elemencie #app -->
            <user-edit :user-id="{{ $id }}"></user-edit>
        </div>
    </div>

    <a href="{{ route('users.index') }}" class="btn btn-secondary">Powrót do listy</a>
    <form method="POST" action="{{ route('users.update', $id) }}">
        @csrf
        <!-- Reszta pól formularza -->
        <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
        
@endsection
