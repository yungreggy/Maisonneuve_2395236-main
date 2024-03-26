@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-file-alt"></i> {{ $document->titre }}</h4>
                </div>
                <div class="card-body">
                    <p><strong> {{__('all.titre')}}:</strong> {{ $document->titre }}</p>
                    <p><strong> {{__('all.langue')}} :</strong> {{ $document->langue }}</p>
                    <p><strong> Type :</strong> {{ pathinfo($document->fichier, PATHINFO_EXTENSION) }}</p>
                    <p><strong>{{__('all.taille')}} :</strong> {{ number_format($document->taille / 1024, 2) }} Ko</p>
                    <p class=" "><strong>{{__('all.auteur')}} : </strong> <a href="{{ route('etudiants.show', $document->etudiant_id) }}">{{ $document->etudiant->nom ?? 'Inconnu' }}</a></p>
                    <p><strong><i class="fas fa-calendar-alt"></i> {{__('all.date_creation')}}</strong> {{ $document->created_at->format('d/m/Y H:i') }}</p>
                    <a href="{{ route('documents.download', $document->id) }}" class="btn btn-primary">
                        <i class="fa fa-download"></i> 
                    </a>
                    @if(Auth::check() && (Auth::user()->id === $document->etudiant->user_id || Auth::user()->is_admin))
    <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-primary">
        <i class="fas fa-edit"></i> <!-- Icône pour Modifier -->
    </a>
    <form action="{{ route('documents.destroy', $document->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger " onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce document ?');">
            <i class="fas fa-trash-alt"></i> <!-- Icône pour Supprimer -->
        </button>
    </form>
@endif



                </div>
            </div>
        </div>
    </div>
</div>
@endsection



