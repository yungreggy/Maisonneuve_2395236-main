@extends('layouts.app')

@section('content')
<div class="container my-5">
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

    <div class="card shadow">
        <div class="card-body">
            <h1 class="card-title text-primary">{{ $article->titre }}</h1>
            <hr>
            <p class="card-text">{{ $article->contenu }}</p>

            <div class="mb-3">
                <strong>{{ __('all.ecrit_par') }} :</strong>
                @if ($article->etudiant)
                    <a href="{{ route('etudiants.show', $article->etudiant->id) }}" class="card-link">{{ $article->etudiant->nom }}</a>
                @elseif ($article->admin_id)
                    {{ App\Models\User::find($article->admin_id)->name ?? __('all.inconnu') }}
                @else
                    {{ __('all.inconnu') }}
                @endif
            </div>

            <div class="mb-3">
                <strong>{{ __('all.date_publication') }} :</strong>
                {{ $article->date_publication->format('d/m/Y H:i') }}
            </div>

            <div class="mb-3">
                <strong>{{ __('all.langue') }} :</strong>
                {{ $article->langue }}
            </div>

            @if(auth()->check() && auth()->user()->is_admin)
                <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-edit"></i> {{ __('all.modifier') }}
                </a>
                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('{{ __('all.confirm_suppression') }}');">
                        <i class="fas fa-trash"></i> {{ __('all.supprimer') }}
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection

