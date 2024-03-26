<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ArticleController extends Controller
{
    public function index()
    {
        $langue = app()->getLocale(); 
        $articles = Article::where('langue', $langue) 
                      ->orderBy('date_publication', 'desc')
                      ->paginate(10);
    
        return view('articles.index', compact('articles'));
    }
    
    

    public function show($id)
    {
        $article = Article::findOrFail($id);
        $article->date_publication = Carbon::parse($article->date_publication);
        return view('articles.show', compact('article'));
    }

    public function create()
    {
        $this->authorize('create', Article::class);
        return view('articles.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'langue' => 'required|string|in:fr,en',
        ]);
    
        $userId = auth()->id();
        $user = auth()->user();
        
        $isAdmin = $user->is_admin ?? false;
    
        $etudiant = Etudiant::where('user_id', $userId)->first();
        $articleEtudiantId = null;
        $adminId = null;
    
        if ($isAdmin) {
            $adminId = $userId; 
        } elseif ($etudiant) {
            $articleEtudiantId = $etudiant->id; 
        } else {
          
            return back()->withErrors(['error' => 'Vous n\'avez pas les autorisations nécessaires pour créer un article.'])->withInput();
        }
    
        $article = new Article();
        $article->titre = $request->titre;
        $article->contenu = $request->contenu;
        $article->langue = $request->langue;
        $article->etudiant_id = $articleEtudiantId; // Utilise l'ID défini précédemment
        $article->admin_id = $adminId; 
        $article->date_publication = now();
        $article->save();
    
        return redirect()->route('articles.index')->with('success', 'Article créé avec succès.');
    }
    
    
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        
        // Vérifie si l'utilisateur connecté est l'administrateur ou l'auteur de l'article
        if (Auth::check() && (Auth::user()->is_admin || Auth::user()->id === optional($article->etudiant)->user_id)) {
            return view('articles.edit', compact('article'));
        }
    
        // Si l'utilisateur n'est ni l'administrateur ni l'auteur de l'article, renvoie une erreur 403
        abort(403, 'Vous n\'êtes pas autorisé à modifier cet article.');
    }
    

    public function update(Request $request, $id)
{
    $article = Article::findOrFail($id);
    
    // Vérifie si l'utilisateur est un administrateur ou l'auteur de l'article
    $isAuthor = $article->etudiant && $article->etudiant->user_id == auth()->id();
    if (auth()->user()->is_admin || $isAuthor) {
        $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'langue' => 'required|string|in:fr,en', 
        ]);

        $article->titre = $request->titre;
        $article->contenu = $request->contenu;
        $article->langue = $request->langue;
        $article->save();

        return redirect()->route('articles.index')->with('success', 'Article mis à jour avec succès');
    }

    return back()->with('error', 'Vous n\'avez pas l\'autorisation de modifier cet article');
}

    

    public function destroy($id)
    {
        try {
            $article = Article::findOrFail($id);
            $this->authorize('delete', $article);
            $article->delete();
            return redirect()->route('articles.index')->with('success', 'Article supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('articles.index')->with('error', 'Erreur lors de la suppression de l\'article.');
        }
    }
}

