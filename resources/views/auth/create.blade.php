@extends('layouts.app')

@section('title', __('all.login'))

@section('content')
@if(!$errors->isEmpty())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<img src="{{ asset('images/chez-toi.jpg') }}" alt="chez-toi" title="chez-toi" style="position: absolute; top: 0; left: 0; width:300px; margin-left: 20%; margin-top: 10% ">


<div class="container d-flex justify-content-center align-items-center" style="margin-left: 35%; margin-top: 10%">
    <div class="card w-50">
        <div class="card-header">
            <h5 class="card-title">{{ __('all.login') }}</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">{{ __('all.email') }}</label>
                    <input type="email" class="form-control" id="username" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('all.password') }}</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('all.login_button') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection


