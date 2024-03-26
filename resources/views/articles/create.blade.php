@extends('layouts.app')

@section('title', __('all.creer_article'))

@section('content')
<div class="container">
    <h1>{{ __('all.creer_article') }}</h1>
    <form method="POST" action="{{ route('articles.store') }}">
        @csrf
        <div class="form-group">
            <label for="titre">{{ __('all.titre') }}</label>
            <input type="text" class="form-control" id="titre" name="titre" placeholder="{{ __('all.entrez_titre') }}" required>
            @error('titre')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="contenu">{{ __('all.contenu') }}</label>
            <textarea class="form-control" id="contenu" name="contenu" rows="5" placeholder="{{ __('all.entrez_contenu') }}" required></textarea>
            @error('contenu')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
    <label for="langue">{{ __('all.langue') }}</label>
    <select class="form-control" id="langue" name="langue">
        <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>{{ __('all.francais') }}</option>
        <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>{{ __('all.anglais') }}</option>
    </select>
    @error('langue')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>


        <button type="submit" class="btn btn-primary">{{ __('all.publier') }}</button>
    </form>
</div>
@endsection
