@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between">
        @if(auth()->check() && auth()->user()->etudiant && auth()->user()->etudiant->id == $etudiant->id)
            <h1 class="mb-4 display-4">{{ __('all.votre_profil_etudiant') }}</h1>
        @else
            <h1 class="mb-4 display-4">{{ __('all.details_etudiant') }}</h1>
        @endif
    </div>

    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
            {{ __('all.etudiant_id') }}{{ $etudiant->id }}
        </div>
        <div class="card-body">
            <h5 class="card-title h3 mb-3 font-weight-bold">{{ $etudiant->nom }}</h5>
            <p class="card-text"><strong>{{ __('all.adresse') }}</strong> {{ $etudiant->adresse }}</p>
            <p class="card-text"><strong>{{ __('all.telephone') }}</strong> {{ $etudiant->telephone }}</p>
            <p class="card-text"><strong>{{ __('all.email') }}</strong> {{ $etudiant->email }}</p>
            <p class="card-text"><strong>{{ __('all.date_naissance') }}</strong> {{ $etudiant->date_naissance }}</p>
            <p class="card-text"><strong>{{ __('all.ville') }}</strong> {{ $etudiant->ville->nom ?? 'Non renseigné' }}</p>

            @if(auth()->check() && (auth()->user()->is_admin || (auth()->user()->etudiant && auth()->user()->etudiant->id == $etudiant->id)))
                <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-outline-warning">{{ __('all.modifier') }}</a>
                <button type="submit" class="btn btn-outline-danger" form="delete-form">{{ __('all.supprimer') }}</button>
                <form id="delete-form" action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>
            @endif

            <a href="{{ route('etudiants.index') }}" class="btn btn-outline-primary">{{ __('all.retour_liste') }}</a>
        </div>
    </div>
    <br>

    <h2 class="mb-3 display-7">{{ __('all.articles_ecrits') }} {{ $etudiant->nom }}</h2>
    <hr>
    @forelse ($etudiant->articles as $article)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $article->titre }}</h5>
                <p class="card-text">{{ Str::limit($article->contenu, 150) }}</p>
                <a href="{{ route('articles.show', $article->id) }}" class="btn btn-outline-primary">{{ __('all.lire_article') }}</a>
            </div>
        </div>
    @empty
        <p>{{ __('all.aucun_article_trouve') }}</p>
    @endforelse
    <br>

    <h2 class="mb-3">{{ __('all.documents_televerses') }} {{ $etudiant->nom }}</h2>
    <hr>
    @forelse ($etudiant->documents as $document)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $document->titre }}</h5>
                <p class="card-text"><strong>{{ __('all.type') }} :</strong> {{ pathinfo($document->fichier, PATHINFO_EXTENSION) }}</p>
                <p class="card-text"><strong>{{ __('all.taille') }} :</strong> {{ number_format($document->taille / 1024, 2) }} Ko</p>
                <a href="{{ route('documents.show', $document->id) }}" class="btn btn-outline-primary">{{ __('all.consulter_document') }}</a>
                
                @if(auth()->check() && (auth()->user()->is_admin || (auth()->user()->etudiant && auth()->user()->etudiant->id == $document->etudiant_id)))
                    <form action="{{ route('documents.destroy', $document->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('{{ __('all.etes_vous_sur_supprimer') }}');">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <p>{{ __('all.aucun_document_trouve') }}</p>
    @endforelse


    <br>
</div>
@endsection



