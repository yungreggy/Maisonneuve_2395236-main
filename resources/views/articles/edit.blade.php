@extends('layouts.app')

@section('title', __('all.modifier_article'))
<br>
<br>

@section('content')
<div class="container">
    <h1>{{ __('all.modifier_article') }}</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="{{ route('articles.update', $article->id) }}" novalidate>
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="titre">{{ __('all.titre') }}</label>
            <input type="text" class="form-control" id="titre" name="titre" value="{{ old('titre', $article->titre) }}" required>
            @error('titre')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="contenu">{{ __('all.contenu') }}</label>
            <textarea class="form-control" id="contenu" name="contenu" rows="5" required>{{ old('contenu', $article->contenu) }}</textarea>
            @error('contenu')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="langue">{{ __('all.langue') }}</label>
            <select class="form-control" id="langue" name="langue">
                <option value="fr" @if (old('langue', $article->langue) == 'fr') selected @endif>{{ __('all.francais') }}</option>
                <option value="en" @if (old('langue', $article->langue) == 'en') selected @endif>{{ __('all.anglais') }}</option>
            </select>
            @error('langue')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ __('all.mettre_a_jour') }}</button>
    </form>
</div>
@endsection

