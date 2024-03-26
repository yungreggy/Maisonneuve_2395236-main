@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 display-4">{{ __('all.repertoire_documents') }}</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div class="container mt-5">
    <div class="bg-light p-5 rounded shadow">
        <h2>{{ __('all.televerser_document') }}</h2>

        <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data" class="mt-3 needs-validation" novalidate>
            @csrf

            <div class="form-group mb-3">
                <label for="titre" class="form-label">{{ __('all.titre') }}</label>
                <input type="text" class="form-control form-control-lg" id="titre" name="titre" placeholder="{{ __('all.entrez_titre_document') }}" required>
                <div class="invalid-feedback">
                    {{ __('all.titre_document_requis') }}
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="langue" class="form-label">{{ __('all.langue') }}</label>
                <select class="form-control form-control-lg" id="langue" name="langue" required>
                    <option value="">{{ __('all.choisir_langue') }}...</option>
                    <option value="fr">{{ __('all.francais') }}</option>
                    <option value="en">{{ __('all.anglais') }}</option>
                </select>
                <div class="invalid-feedback">
                    {{ __('all.langue_document_requise') }}
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="fichier" class="form-label">{{ __('all.fichier') }}</label>
                <input type="file" class="form-control-file" id="fichier" name="fichier" required>
                <div class="invalid-feedback">
                    {{ __('all.fichier_requis') }}
                </div>
            </div>

            <button type="submit" class="btn btn-outline-primary btn-lg">{{ __('all.televerser') }}</button>
        </form>
    </div>
    <table class="table table-striped mt-5">
        <thead class="table-dark">
            <tr>
                <th>{{ __('all.titre') }}</th>
                <th>{{ __('all.type') }}</th>
                <th>{{ __('all.taille') }}</th>
                <th>{{ __('all.proprietaire') }}</th>
                <th>{{ __('all.date_creation') }}</th>
                <th>{{ __('all.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($documents as $document)
            <tr>
                <td><a href="{{ route('documents.show', $document->id) }}">{{ $document->titre }}</a></td>
                <td>{{ pathinfo($document->fichier, PATHINFO_EXTENSION) }}</td>
                <td>{{ number_format($document->taille / 1024, 2) }} Ko</td>
                <td><a href="{{ route('etudiants.show', $document->etudiant_id) }}" class="link-info">{{ $document->etudiant->nom ?? __('all.inconnu') }}</a></td>
                <td>{{ $document->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <a href="{{ route('documents.download', $document->id) }}" class="btn btn-primary">
                        <i class="fa fa-download"></i> {{ __('all.telecharger') }}
                    </a>
                    @can('update', $document)
                    <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-secondary btn-sm">{{ __('all.modifier') }}</a>
                    @endcan
                    @can('delete', $document)
                    <form action="{{ route('documents.destroy', $document->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('all.etes_vous_sur_supprimer') }}');">{{ __('all.supprimer') }}</button>
                    </form>
                    @endcan
              
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">{{ __('all.aucun_document_trouve') }}</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $documents->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
@endpush
