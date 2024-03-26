@extends('layouts.app')

@section('title', __('Ajouter un administrateur'))

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center">{{ __('all.add_admin') }}</h1>
    @include('partials.errors')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('all.name') }}</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('all.email') }}</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('all.password') }}</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">{{ __('all.confirm_password') }}</label>
                            <input type="password" class="form-control" id="password-confirm" name="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('all.add') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection