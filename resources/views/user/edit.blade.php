@extends('layouts.app')

@section('title', __('all.modifier_utilisateur'))

@section('content')
<div class="container " style="margin-top: 100px;">
    <h1 class="text-center">{{ __('all.modifier_utilisateur') }}</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('all.modifier_utilisateur_id') . $user->id }}
                </div>
                <div class="card-body">
                    <form action="{{ route('user.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('all.nom') }}</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('all.email') }}</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('all.nouveau_mot_de_passe') }}</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">{{ __('all.confirmer_nouveau_mot_de_passe') }}</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('all.enregistrer_modifications') }}</button>
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">{{ __('all.annuler') }}</a>
                    </form>
                    
                    <form action="{{ route('user.destroy', [$user->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('{{ __('all.etes_vous_sure_supprimer_this_user') }}');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i> {{ __('all.supprimer') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



