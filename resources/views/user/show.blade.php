@extends('layouts.app')

@section('title', 'Profil de l\'utilisateur')

@section('content')
<div class="container">
    <h1 class="mt-5">Profil de l'utilisateur</h1>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Utilisateur #{{ $user->id }}
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="card-text"><strong>Email :</strong> {{ $user->email }}</p>
                    <p class="card-text"><strong>Rôle :</strong> {{ $user->is_admin ? 'Administrateur' : 'Utilisateur' }}</p>
                    <p class="card-text"><strong>Date de création :</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
                    <p class="card-text"><strong>Dernière mise à jour :</strong> {{ $user->updated_at->format('d/m/Y H:i') }}</p>

                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Modifier</a>
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
