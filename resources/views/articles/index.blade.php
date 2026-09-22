@extends('layouts.app')

@section('title', 'Liste des articles')

@section('content')
    <h1>Liste des articles</h1>

    @auth
        <p>
            Connecté en tant que {{ auth()->user()->name }}
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit">Se déconnecter</button>
            </form>
        </p>
    @else
        <p><a href="{{ route('login') }}">Connectez-vous pour gérer les articles</a></p>
    @endauth

    @can('owner')
        <p><a href="{{ route('articles.create') }}">Ajouter un nouvel article</a></p>
    @endcan

    <table border="1">
        <thead>
            <tr><th>Titre</th><th>Prix</th><th>Date</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @forelse ($articles as $article)
                <tr>
                    <td>{{ $article->titre }}</td>
                    <td>{{ number_format($article->price, 2, ',', ' ') }} €</td>
                    <td>{{ $article->created_at?->format('d/m/Y') }}</td>
                    <td>
                        @can('owner')
                            <a href="{{ route('articles.edit', $article) }}">Éditer</a>
                            <form action="{{ route('articles.destroy', $article) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Supprimer</button>
                            </form>
                        @endcan
                        <form action="{{ route('cart.store') }}" method="POST" style="display:inline">
                            @csrf
                            <input type="hidden" name="product_id" value="article-{{ $article->id }}">
                            <button type="submit">Ajouter au panier</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Aucun article.</td></tr>
            @endforelse
        </tbody>
    </table>

    @include('partials.cart')
@endsection
