@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="container mt-3">
        <h1 class="display-4">{{ __('all.liste_etudiants') }}</h1>

        <form action="{{ route('etudiants.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="{{ __('all.rechercher_etudiant') }}" name="q" aria-label="Rechercher">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">{{ __('all.rechercher') }}</button>
                </div>
            </div>
        </form>

        <div class="filter-container my-3">
            <a href="{{ route('etudiants.index', ['sort' => 'asc']) }}" class="btn btn-outline-primary">{{ __('all.tri_a_z') }}</a>
            <a href="{{ route('etudiants.index', ['sort' => 'desc']) }}" class="btn btn-outline-primary">{{ __('all.tri_z_a') }}</a>
        </div>

        <div class="alphabet-filter mb-3">
            @foreach(range('A', 'Z') as $letter)
                <a href="{{ route('etudiants.index', ['filter' => $letter]) }}" class="btn btn-outline-secondary {{ request()->get('filter') == $letter ? 'active' : '' }}">{{ $letter }}</a>
            @endforeach
        </div>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>{{ __('all.nom') }}</th>
                    <th>{{ __('all.email') }}</th>
                    <th>{{ __('all.ville') }}</th>
                    @if(Auth::user()->is_admin)
                        <th>{{ __('all.actions') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($etudiants as $etudiant)
                    <tr>
                        <td><a href="{{ route('etudiants.show', $etudiant->id) }}">{{ $etudiant->nom }}</a></td>
                        <td>{{ $etudiant->email }}</td>
                        <td>{{ $etudiant->ville->nom ?? __('all.non_renseigne') }}</td>
                        @if(Auth::user()->is_admin)
                            <td>
                                <a href="{{ route('etudiants.show', $etudiant->id) }}" class="btn btn-info btn-sm" aria-label="{{ __('all.voir_details') }}"> {{ __('all.voir_details') }}</a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $etudiants->links() }}
    </div>
</div>
@endsection

