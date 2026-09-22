@extends('layouts.app')

@section('title', "Éditer l'article")

@section('content')
    <h1>Éditer l'article</h1>

    <form action="{{ route('articles.update', $article) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="titre">Titre:</label>
        <input type="text" name="titre" id="titre" value="{{ old('titre', $article->titre) }}" required>

        <label for="contenu">Contenu:</label>
        <textarea name="contenu" id="contenu" required>{{ old('contenu', $article->contenu) }}</textarea>

        <label for="prix">Prix (€):</label>
        <input type="number" name="prix" id="prix" min="0" step="0.01" value="{{ old('prix', $article->price) }}" required>

        <button type="submit">Mettre à jour</button>
    </form>

    <a href="{{ route('articles.index') }}">Retour à la liste</a>
@endsection
