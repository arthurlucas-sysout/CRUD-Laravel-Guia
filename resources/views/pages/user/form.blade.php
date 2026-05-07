@extends('layouts.default')

@section('content')

    <div class="page page-user page-form">

        @include('components.alert')

        <h1>Formulário de Usuários</h1>

        <form method="POST" action="{{ url('/usuario')}}">

            @csrf

            @method($user->id ? 'PUT' : 'POST')

            <input type="hidden" name="id" value="{{ $user->id }}" />

            <div class="form-group">
                <label for="">Nome</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" maxlength="30" required>
            </div>

            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" maxlength="50" required>
            </div>

            <div class="form-group">
                <label for="">Senha</label>
                <input type="password" name="password" class="form-control" minlength="8" maxlength="16" {{ !$user->password ? 'required' : '' }}>
            </div>

            <a href="{{ url('/usuarios') }}">Voltar</a>

            <button type="submit">Enviar</button>

        </form>

    </div>

    @endsection
