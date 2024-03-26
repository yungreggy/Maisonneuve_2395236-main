@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-file-alt"></i> Modifier le document</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('documents.update', $document->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input type="text" id="titre" name="titre" class="form-control" value="{{ $document->titre }}" required>
                        </div>

                        <div class="form-group">
                            <label for="langue">Langue</label>
                            <select id="langue" name="langue" class="form-control" required>
                                <option value="fr" {{ $document->langue == 'fr' ? 'selected' : '' }}>Français</option>
                                <option value="en" {{ $document->langue == 'en' ? 'selected' : '' }}>Anglais</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fichier">Fichier</label>
                            <input type="file" id="fichier" name="fichier" class="form-control-file">
                        </div>

                        <div class="row" style="margin-left: 10px; gap: 10px">
                        @if($document->fichier)
                            <div class="form-group">
                                <a href="{{ route('documents.download', $document->id) }}" class="btn btn-primary">
                                    <i class="fas fa-download"></i> Télécharger
                                </a>
                            </div>
                        @endif

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Sauvegarder
                            </button>
                        </div>
                    </form>

                    @if(auth()->user()->is_admin || $document->etudiant_id == auth()->user()->etudiant->id)
                        <form action="{{ route('documents.destroy', $document->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce document ?');">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection





