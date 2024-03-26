@extends('layouts.app')

@section('title', __('all.welcome'))

@section('content')
<div class="container-fluid p-5">
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron bg-white shadow rounded">
                @guest
                <h1 class="display-4">{{ __('all.welcome') }}</h1>
                <p class="lead">{{ __('all.official_site') }}</p>
                <hr class="my-4">
                <p>{{ __('all.join_us') }}</p>
                <a href="{{ route('etudiants.create') }}" class="btn btn-primary btn-lg">{{ __('all.create_account') }}</a>
                @else
                <h1 class="display-4">{{ __('all.welcome_back', ['name' => Auth::user()->name]) }}</h1>
                <p class="lead">{{ __('all.access_space') }}</p>
                <hr class="my-4">
                <p>{{ __('all.explore') }}</p>
                <a href="{{ route('etudiants.index') }}" class="btn btn-outline-primary btn-lg">{{ __('all.view_students') }}</a>
                @endguest
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <img src="{{ asset('images/college-2.jpeg') }}" alt="College" class="img-fluid rounded shadow">
        </div>
    </div>
</div>
@endsection
