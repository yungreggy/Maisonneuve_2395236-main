@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h1 class="display-4">{{ __('all.bienvenue_forum') }}</h1>
    <div class="my-4">
        <a href="{{ route('articles.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> {{ __('all.ajouter_article') }}
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="list-group mt-4">
        @forelse ($articles as $article)
        <div class="card mb-3 shadow">
            <div class="card-body">
                <h5 class="card-title">{{ $article->titre }}</h5>
                <p class="card-text">{{ Str::limit($article->contenu, 150) }}</p>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <small class="text-muted">{{ __('all.publie') }} {{ $article->created_at->diffForHumans() }}</small>
                <span>{{ __('all.ecrit_par') }} :
                    @if ($article->etudiant)
                        <a href="{{ route('etudiants.show', $article->etudiant->id) }}">{{ $article->etudiant->nom }}</a>
                    @elseif ($article->admin_id)
                        {{ App\Models\User::find($article->admin_id)->name ?? __('all.admin') }}
                    @else
                        {{ __('all.inconnu') }}
                    @endif
                </span>
            </div>

            <div class="card-footer text-right">
                <a href="{{ route('articles.show', $article->id) }}" class="btn btn-outline-primary btn-sm p-2">
                    <i class="fas fa-eye"></i>
                </a>
                @auth
                @if(auth()->user()->is_admin || (optional($article->etudiant)->user_id === auth()->user()->id))
                <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-outline-secondary btn-sm p-2">
                    <i class="fas fa-edit"></i>
                </a>
                <button type="submit" class="btn btn-outline-danger btn-sm p-2" form="delete-form-{{ $article->id }}" onclick="return confirm('{{ __('all.confirm_suppression') }}');">
                    <i class="fas fa-trash"></i>
                </button>
                <form id="delete-form-{{ $article->id }}" action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
                @endif
                @endauth
            </div>
        </div>
        @empty
        <p class="alert alert-info">{{ __('all.aucun_article_trouve') }}</p>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $articles->links() }}
    </div>
</div>
@endsection

