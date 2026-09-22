<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->get();

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        Gate::authorize('owner');

        return view('articles.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('owner');
        $data = $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'prix' => 'required|numeric|min:0',
        ]);
        Article::create([
            'titre' => $data['titre'],
            'contenu' => $data['contenu'],
            'price' => $data['prix'],
        ]);

        return redirect()->route('articles.index');
    }

    public function edit(Article $article)
    {
        Gate::authorize('owner');

        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        Gate::authorize('owner');
        $data = $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'prix' => 'required|numeric|min:0',
        ]);
        $article->update([
            'titre' => $data['titre'],
            'contenu' => $data['contenu'],
            'price' => $data['prix'],
        ]);

        return redirect()->route('articles.index');
    }

    public function destroy(Article $article)
    {
        Gate::authorize('owner');
        $article->delete();

        return redirect()->route('articles.index');
    }
}
