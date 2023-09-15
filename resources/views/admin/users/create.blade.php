@extends('layouts.app')

@section('content')



    <div id="app">
  
            <div v-if="UserForm">
                <user-form></user-form>
            </div>

    </div>
    ! Występuje błąd przez który po kliknięciu dodaj nie powraca na liste użytkowników, ale użykownik zostaje dodany! 
    <br>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Powrót do listy</a>
@endsection
