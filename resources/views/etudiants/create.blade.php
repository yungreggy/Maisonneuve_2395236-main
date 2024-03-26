@extends('layouts.app')

@section('title', __('all.registration'))

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center">{{ __('all.register_account') }}</h1>

    @include('partials.alerts')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ __('all.registration') }}</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('etudiants.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nom" class="form-label">{{ __('all.name') }}</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('all.email') }}</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('all.password') }}</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="adresse" class="form-label">{{ __('all.address') }}</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" value="{{ old('adresse') }}">
                        </div>
                        <div class="mb-3">
                            <label for="telephone" class="form-label">{{ __('all.phone') }}</label>
                            <input type="text" class="form-control" id="telephone" name="telephone" value="{{ old('telephone') }}">
                        </div>
                        <div class="mb-3">
                            <label for="date_naissance" class="form-label">{{ __('all.birthdate') }}</label>
                            <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}">
                        </div>
                        <div class="mb-3">
                            <label for="ville_nom" class="form-label">{{ __('all.city') }}</label>
                            <input type="text" class="form-control" id="ville_nom" name="ville_nom" placeholder="{{ __('all.city') }}" value="{{ old('ville_nom') }}">
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('all.register') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
