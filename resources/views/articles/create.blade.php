@extends('layouts.app')

@section('title', 'Ajouter un article')

@section('content')
    <h1>Ajouter un nouvel article</h1>

    <form action="{{ route('articles.store') }}" method="POST">
        @csrf
        <label for="titre">Titre:</label>
        <input type="text" name="titre" id="titre" value="{{ old('titre') }}" required>

        <label for="contenu">Contenu:</label>
        <textarea name="contenu" id="contenu" required>{{ old('contenu') }}</textarea>

        <label for="prix">Prix (€):</label>
        <input type="number" name="prix" id="prix" min="0" step="0.01" value="{{ old('prix') }}" required>

        <button type="submit">Ajouter</button>
    </form>

    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('articles.index') }}">Retour à la liste</a>
@endsection
