@extends('layouts.app')

@section('title', __('all.edit_student'))

@section('content')
<div class="container">
    <h1>{{ __('all.edit_student') }}</h1>
    @include('partials.errors')

    <div class="card">
        <div class="card-header">
            {{ __('all.student_number') }}{{ $etudiant->id }}
            <a href="{{ route('etudiants.index') }}" class="btn btn-primary float-right">{{ __('all.return_to_list') }}</a>
        </div>
        <div class="card-body">
            <form action="{{ route('etudiants.update', $etudiant->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nom">{{ __('all.full_name') }}</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $etudiant->nom) }}" required>
                </div>
                <div class="form-group">
                    <label for="adresse">{{ __('all.address') }}</label>
                    <input type="text" class="form-control" id="adresse" name="adresse" value="{{ old('adresse', $etudiant->adresse) }}" required>
                </div>
                <div class="form-group">
                    <label for="telephone">{{ __('all.phone') }}</label>
                    <input type="tel" class="form-control" id="telephone" name="telephone" value="{{ old('telephone', $etudiant->telephone) }}" required>
                </div>
                <div class="form-group">
                    <label for="email">{{ __('all.email') }}</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $etudiant->email) }}" required>
                </div>
                <div class="form-group">
                    <label for="date_naissance">{{ __('all.birthdate') }}</label>
                    <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="{{ old('date_naissance', $etudiant->date_naissance) }}" required>
                </div>
                <div class="form-group">
                    <label for="ville_id">{{ __('all.city') }}</label>
                    <select class="form-control" id="ville_id" name="ville_id">
                        @foreach($villes as $ville)
                            <option value="{{ $ville->id }}" {{ old('ville_id', $etudiant->ville_id) == $ville->id ? 'selected' : '' }}>
                                {{ $ville->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('all.save_changes') }}</button>
            </form>

            <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('{{ __('all.confirm_delete') }}');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">{{ __('all.delete_student') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection



